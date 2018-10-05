<?php

namespace Petryk\ImageBlock\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Filesystem;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper
{
    /**
     * @var string
     */
    public $uploadDirectory = 'imageblock';

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;


    /**
     * @var Filesystem
     */
    protected $_filesystem;

    /**
     * @var AdapterFactory
     */
    protected $_adapterFactory;

    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        Filesystem $filesystem,
        AdapterFactory $adapterFactory
    ) {
        $this->_storeManager = $storeManager;
        $this->_filesystem = $filesystem;
        $this->_adapterFactory = $adapterFactory;
        parent::__construct($context);
    }

    /**
     * Return Upload directory path
     *
     * @return string
     */
    public function getUploadDirectoryPath()
    {
        $mediaPath = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA);
        $uploadDirectoryPath = $mediaPath->getAbsolutePath($this->uploadDirectory) . DIRECTORY_SEPARATOR;

        return $uploadDirectoryPath;
    }

    /**
     * Return Upload directory url
     *
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getUploadDirectoryUrl()
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        $uploadDirectoryUrl = $mediaUrl . $this->uploadDirectory;

        return $uploadDirectoryUrl;
    }

    /**
     * Return image url from config
     *
     * @return mixed
     */
    public function getImageUrlFromConfig()
    {
        return $this->scopeConfig->getValue('image_block/configuration/image_url');
    }

    /**
     * Return image height from config
     *
     * @return mixed
     */
    public function getImageWidthFromConfig()
    {
        return $this->scopeConfig->getValue('image_block/configuration/image_width');
    }

    /**
     * Return image height from config
     *
     * @return mixed
     */
    public function getImageHeightFromConfig()
    {
        return $this->scopeConfig->getValue('image_block/configuration/image_height');
    }

    /**
     * Return image url
     *
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getImageUrl()
    {
        $imageUrlFromConfig = $this->getImageUrlFromConfig();
        $imageUrl = $this->getUploadDirectoryUrl() . DIRECTORY_SEPARATOR . $imageUrlFromConfig;

        return $imageUrl;
    }

    /**
     * Return resized image url
     *
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getResizedImageUrl()
    {
        return $this->resizeImage(
            $this->getImageUrlFromConfig(),
            $this->getImageWidthFromConfig(),
            $this->getImageHeightFromConfig()
        );
    }

    /**
     * Resize image
     *
     * @param $image
     * @param $width
     * @param $height
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function resizeImage($image, $width, $height)
    {
        $imagePath = $this->getUploadDirectoryPath() . $image;
        $imageResizedPath = $this->getUploadDirectoryPath() . '/resized/' . $image;

        $imageResize = $this->_adapterFactory->create();

        $imageResize->open($imagePath);
        $imageResize->constrainOnly(true);
        $imageResize->keepTransparency(true);
        $imageResize->keepFrame(false);
        $imageResize->keepAspectRatio(true);
        $imageResize->resize($width, $height);
        $imageResize->save($imageResizedPath);

        $imageResizedUrl = $this->getUploadDirectoryUrl() . '/resized/' . $image;

        return $imageResizedUrl;
    }
}
