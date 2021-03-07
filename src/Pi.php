<?php
declare(strict_types = 1);

namespace Pastry;

use Pastry\Board\Board;
use Pastry\Board\Cpu;
use Pastry\Board\Revision;
use RuntimeException;

final class Pi {
  private Board $board;
  private Cpu $cpu;
  private Revision $revision;

  private const CPUINFO = '/proc/cpuinfo';

  private function __construct(Board $board, Cpu $cpu, Revision $revision) {
    $this->board    = $board;
    $this->cpu      = $cpu;
    $this->revision = $revision;
  }

  public static function probe(): static {
    if (is_file(self::CPUINFO) === false) {
      throw new RuntimeException('Unsupported operating system!');
    }

    if (is_readable(self::CPUINFO) === false) {
      throw new RuntimeException('Cannot read CPU information from "/proc/cpuinfo"');
    }

    $cpuinfo = array_map(
      function (string $line) {
        return trim(str_replace("\t", ' ', $line));
      },
      file(self::CPUINFO, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
    );

    return new static(
      Board::fromCpuInfo($cpuInfo),
      Cpu::fromCpuInfo($cpuInfo),
      Revision::fromCpuInfo($cpuInfo)
    );
  }

  public function getBoard(): Board {
    return $this->board;
  }

  public function getCpu(): Cpu {
    return $this->cpu;
  }

  public function getRevision(): Revision {
    return $this->revision;
  }
}
