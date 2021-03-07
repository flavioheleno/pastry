<?php
declare(strict_types = 1);

namespace Pastry\Board\Revision;

use Pastry\Board\Revision;
use RuntimeException;

/**
 * @link https://elinux.org/RPi_HardwareHistory
 * @link https://www.raspberrypi.org/documentation/hardware/raspberrypi/revision-codes/README.md
 */
final class NewStyle extends Revision {
  public function __construct(int $revision) {
    $this->releaseDate  = self::RELEASE_MAP[$revision] ?? 'Unknown';
    $this->pcbRevision  = 1.0 + (($revision & 0x0000000f) / 10);
    $this->type         = ($revision >> 0x04) & 0x000000ff;
    $this->processor    = ($revision >> 0x0c) & 0x0000000f;
    $this->manufacturer = ($revision >> 0x10) & 0x0000000f;
    $this->memorySize   = ($revision >> 0x14) & 0x00000007;
    $this->newFlag      = ($revision >> 0x17) & 0x00000001;
    $this->warranty     = ($revision >> 0x19) & 0x00000001;
    $this->otpRead      = ($revision >> 0x1d) & 0x00000001;
    $this->otpProgram   = ($revision >> 0x1e) & 0x00000001;
    $this->overvoltage  = ($revision >> 0x1f) & 0x00000001;
  }
}
