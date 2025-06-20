<?php

declare(strict_types=1);

namespace SPC\builder\unix\library;

use SPC\exception\FileSystemException;
use SPC\exception\RuntimeException;
use SPC\util\executor\UnixCMakeExecutor;

trait zstd
{
    /**
     * @throws RuntimeException
     * @throws FileSystemException
     */
    protected function build(): void
    {
        UnixCMakeExecutor::create($this)
            ->setBuildDir("{$this->source_dir}/build/cmake/build")
            ->addConfigureArgs(
                '-DZSTD_BUILD_STATIC=ON',
                '-DZSTD_BUILD_SHARED=OFF',
            )
            ->build();
        $this->patchPkgconfPrefix(['libzstd.pc']);
    }
}
