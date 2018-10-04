<?php

namespace Petryk\ImageBlock\Plugin;

use Magento\Config\Model\Config\Backend\File;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Petryk\ImageBlock\Helper\Data;

class DeleteUploadedImage
{
    /**
     * @var Filesystem\Directory\WriteInterface
     */
    protected $_mediaDirectory;

    /**
     * DeleteUploadedImage constructor.
     * @param Filesystem $filesystem
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }

    /**
     * @param File $file
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function beforeBeforeSave(File $file)
    {
        $value = $file->getValue();
        $deleteFlag = is_array($value) && !empty($value['delete']);

        $uploadDirectory = $file->getFieldConfig();
        $uploadDirectory = $uploadDirectory['upload_dir']['value'];

        if ($deleteFlag) {
            $this->_mediaDirectory->delete($uploadDirectory . DIRECTORY_SEPARATOR . $value['value']);
        }
    }
}
