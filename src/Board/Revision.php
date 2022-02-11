<?php
declare(strict_types = 1);

namespace Pastry\Board;

use Pastry\Board\Revision\NewStyle;
use Pastry\Board\Revision\OldStyle;
use RuntimeException;

/**
 * @link https://elinux.org/RPi_HardwareHistory
 * @link https://www.raspberrypi.org/documentation/hardware/raspberrypi/revision-codes/README.md
 * @link https://github.com/raspberrypi/documentation/blob/develop/documentation/asciidoc/computers/raspberry-pi/revision-codes.adoc
 */
abstract class Revision {
  protected string $releaseDate;
  protected int $overvoltage;
  protected int $otpProgram;
  protected int $otpRead;
  protected int $warranty;
  protected int $newFlag;
  protected int $memorySize;
  protected int $manufacturer;
  protected int $processor;
  protected int $type;
  protected float $pcbRevision;

  protected const RELEASE_MAP = [
    0x0002   => 'Q1 2012',
    0x0003   => 'Q3 2012',
    0x0004   => 'Q3 2012',
    0x0005   => 'Q4 2012',
    0x0006   => 'Q4 2012',
    0x0007   => 'Q1 2013',
    0x0008   => 'Q1 2013',
    0x0009   => 'Q1 2013',
    0x000d   => 'Q4 2012',
    0x000e   => 'Q4 2012',
    0x000f   => 'Q4 2012',
    0x0010   => 'Q3 2014',
    0x0011   => 'Q2 2014',
    0x0012   => 'Q4 2014',
    0x0013   => 'Q1 2015',
    0x0014   => 'Q2 2014',
    0x0015   => 'Unknown',
    0xa01040 => 'Unknown',
    0xa01041 => 'Q1 2015',
    0xa21041 => 'Q1 2015',
    0xa22042 => 'Q3 2016',
    0x900021 => 'Q3 2016',
    0x900032 => 'Q2 2016',
    0x900092 => 'Q4 2015',
    0x900093 => 'Q2 2016',
    0x920093 => 'Q4 2016',
    0x9000c1 => 'Q1 2017',
    0xa02082 => 'Q1 2016',
    0xa020a0 => 'Q1 2017',
    0xa22082 => 'Q1 2016',
    0xa32082 => 'Q4 2016',
    0xa020d3 => 'Q1 2018',
    0x9020e0 => 'Q4 2018',
    0xa02100 => 'Q1 2019',
    0xa03111 => 'Q2 2019',
    0xb03111 => 'Q2 2019',
    0xb03112 => 'Q2 2019',
    0xb03114 => 'Q2 2020',
    0xc03111 => 'Q2 2019',
    0xc03112 => 'Q2 2019',
    0xc03114 => 'Q2 2020',
    0xd03114 => 'Q2 2020',
    0x902120 => 'Q4 2021'
  ];


  public const OVERVOLTAGE = [
    'Overvoltage allowed',
    'Overvoltage disallowed'
  ];

  public const OTP_PROGRAM = [
    'OTP programming allowed',
    'OTP programming disallowed'
  ];

  public const OTP_READ = [
    'OTP reading allowed',
    'OTP reading disallowed'
  ];

  public const WARRANTY = [
    'Warranty is intact',
    'Warranty has been voided by overclocking'
  ];

  public const NEW_FLAG = [
    'old-style revision',
    'new-style revision'
  ];

  public const MEMORY_SIZE = [
    '256MB',
    '512MB',
    '1GB',
    '2GB',
    '4GB',
    '8GB'
  ];

  public const MANUFACTURER = [
    'Sony UK',
    'Egoman',
    'Embest',
    'Sony Japan',
    'Embest',
    'Stadium'
  ];

  public const PROCESSOR = [
    'BCM2835',
    'BCM2836',
    'BCM2837',
    'BCM2711'
  ];

  public const TYPE = [
    'A',
    'B',
    'A+',
    'B+',
    '2B',
    'Alpha (early prototype)',
    'CM1',
    '3B',
    'Zero',
    'CM3',
    '',
    'Zero W',
    '3B+',
    '3A+',
    'Internal use only',
    'CM3+',
    '4B',
    'Zero 2 W',
    '400',
    'CM4'
  ];

  public static function fromCpuInfo(array $info): static {
    $revision = -1;
    foreach ($info as $line) {
      if (preg_match('/^revision *: (.*)$/i', $line, $match) === 1) {
        $revision = hexdec($match[1]);

        break;
      }
    }

    if ($revision === -1) {
      throw new RuntimeException('Failed to extract revision number from /proc/cpuinfo output');
    }

    if ($revision <= 0x0015) {
      return new OldStyle($revision);
    }

    return new NewStyle($revision);
  }

  public function getReleaseDate(): string {
    return $this->releaseDate;
  }

  public function getOvervoltage(): int {
    return $this->overvoltage;
  }

  public function getOtpProgram(): int {
    return $this->otpProgram;
  }

  public function getOtpRead(): int {
    return $this->otpRead;
  }

  public function getWarranty(): int {
    return $this->warranty;
  }

  public function getNewFlag(): int {
    return $this->newFlag;
  }

  public function getMemorySize(): int {
    return $this->memorySize;
  }

  public function getManufacturer(): int {
    return $this->manufacturer;
  }

  public function getProcessor(): int {
    return $this->processor;
  }

  public function getType(): int {
    return $this->type;
  }

  public function getPcbRevision(): float {
    return $this->pcbRevision;
  }
}
