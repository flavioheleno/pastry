<?php
declare(strict_types = 1);

namespace Pastry\Board\Revision;

use Pastry\Board\Revision;
use RuntimeException;

/**
 * @link https://elinux.org/RPi_HardwareHistory
 * @link https://www.raspberrypi.org/documentation/hardware/raspberrypi/revision-codes/README.md
 */
final class OldStyle extends Revision {
  private const CODE_MAP = [
    0x0002 => [
      'type'         => 1,
      'revision'     => 1.0,
      'memorySize'   => 0,
      'manufacturer' => 1
    ],
    0x0003 => [
      'type'         => 1,
      'revision'     => 1.0,
      'memorySize'   => 0,
      'manufacturer' => 1
    ],
    0x0004 => [
      'type'         => 1,
      'revision'     => 2.0,
      'memorySize'   => 0,
      'manufacturer' => 0
    ],
    0x0005 => [
      'type'         => 1,
      'revision'     => 2.0,
      'memorySize'   => 0,
      'manufacturer' => -1
    ],
    0x0006 => [
      'type'         => 1,
      'revision'     => 2.0,
      'memorySize'   => 0,
      'manufacturer' => 1
    ],
    0x0007 => [
      'type'         => 0,
      'revision'     => 2.0,
      'memorySize'   => 0,
      'manufacturer' => 1
    ],
    0x0008 => [
      'type'         => 0,
      'revision'     => 2.0,
      'memorySize'   => 0,
      'manufacturer' => 0
    ],
    0x0009 => [
      'type'         => 0,
      'revision'     => 2.0,
      'memorySize'   => 0,
      'manufacturer' => -1
    ],
    0x000d => [
      'type'         => 1,
      'revision'     => 2.0,
      'memorySize'   => 1,
      'manufacturer' => 1
    ],
    0x000e => [
      'type'         => 1,
      'revision'     => 2.0,
      'memorySize'   => 1,
      'manufacturer' => 0
    ],
    0x000f => [
      'type'         => 1,
      'revision'     => 2.0,
      'memorySize'   => 1,
      'manufacturer' => 1
    ],
    0x0010 => [
      'type'         => 3,
      'revision'     => 1.2,
      'memorySize'   => 1,
      'manufacturer' => 0
    ],
    0x0011 => [
      'type'         => 6,
      'revision'     => 1.0,
      'memorySize'   => 1,
      'manufacturer' => 0
    ],
    0x0012 => [
      'type'         => 2,
      'revision'     => 1.1,
      'memorySize'   => 0,
      'manufacturer' => 0
    ],
    0x0013 => [
      'type'         => 3,
      'revision'     => 1.2,
      'memorySize'   => 1,
      'manufacturer' => 2
    ],
    0x0014 => [
      'type'         => 6,
      'revision'     => 1.0,
      'memorySize'   => 1,
      'manufacturer' => 2
    ],
    0x0015 => [
      'type'         => 2,
      'revision'     => 1.1,
      'memorySize'   => -1,
      'manufacturer' => 2
    ]
  ];

  public function __construct(int $revision) {
    $this->releaseDate  = self::RELEASE_MAP[$revision] ?? 'Unknown';
    $this->pcbRevision  = self::CODE_MAP[$revision]['revision'];
    $this->type         = self::CODE_MAP[$revision]['type'];
    $this->processor    = -1;
    $this->manufacturer = self::CODE_MAP[$revision]['manufacturer'];
    $this->memorySize   = self::CODE_MAP[$revision]['memorySize'];
    $this->newFlag      = 0;
    $this->warranty     = -1;
    $this->otpRead      = -1;
    $this->otpProgram   = -1;
    $this->overvoltage  = -1;
  }
}
