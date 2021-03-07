<?php
declare(strict_types = 1);

namespace Pastry\Board;

final class Cpu {
  private int $count;
  private string $modelName;
  private float $bogoMips;
  private array $features;
  private int $implementer;
  private int $architecture;
  private int $variant;
  private int $part;
  private int $revision;

  private function __construct(
    int $count,
    string $modelName,
    float $bogoMips,
    array $features,
    int $implementer,
    int $architecture,
    int $variant,
    int $part,
    int $revision
  ) {
    $this->count        = $count;
    $this->modelName    = $modelName;
    $this->bogoMips     = $bogoMips;
    $this->features     = $features;
    $this->implementer  = $implementer;
    $this->architecture = $architecture;
    $this->variant      = $variant;
    $this->part         = $part;
    $this->revision     = $revision;
  }

  public static function fromCpuInfo(array $info): static {
    $count = 0;
    $modelName = '';
    $bogoMips = -1.0;
    $features = [];
    $implementer = -1;
    $architecture = -1;
    $variant = -1;
    $part = -1;
    $revision = -1;

    foreach (array_unique($info) as $line) {
      if (preg_match('/^processor +: /i', $line) === 1) {
        $count++;

        continue;
      }

      if (preg_match('/^model name *: (.*)$/i', $line, $match) === 1) {
        $modelName = $match[1];

        continue;
      }

      if (preg_match('/^bogomips *: (.*)$/i', $line, $match) === 1) {
        $bogoMips = (float)$match[1];

        continue;
      }

      if (preg_match('/^features *: (.*)$/i', $line, $match) === 1) {
        $features = explode(' ', $match[1]);

        continue;
      }

      if (preg_match('/^cpu implementer *: (.*)$/i', $line, $match) === 1) {
        $implementer = hexdec($match[1]);

        continue;
      }

      if (preg_match('/^cpu architecture *: (.*)$/i', $line, $match) === 1) {
        $architecture = (int)$match[1];

        continue;
      }

      if (preg_match('/^cpu variant *: (.*)$/i', $line, $match) === 1) {
        $variant = hexdec($match[1]);

        continue;
      }

      if (preg_match('/^cpu part *: (.*)$/i', $line, $match) === 1) {
        $part = hexdec($match[1]);

        continue;
      }

      if (preg_match('/^cpu revision *: (.*)$/i', $line, $match) === 1) {
        $revision = (int)$match[1];
      }
    }

    return new static(
      $count,
      $modelName,
      $bogoMips,
      $features,
      $implementer,
      $architecture,
      $variant,
      $part,
      $revision
    );
  }

  public function getCount(): int {
    return $this->count;
  }

  public function getModelName(): string {
    return $this->modelName;
  }

  public function getBogoMips(): float {
    return $this->bogoMips;
  }

  public function getFeatures(): array {
    return $this->features;
  }

  public function getImplementer(): int {
    return $this->implementer;
  }

  public function getArchitecture(): int {
    return $this->architecture;
  }

  public function getVariant(): int {
    return $this->variant;
  }

  public function getPart(): int {
    return $this->part;
  }

  public function getRevision(): int {
    return $this->revision;
  }
}
