<?php
declare(strict_types = 1);

namespace Pastry\Pin;

final class Pin {
  private int $physical;
  private int $gpio;
  private int $wiringPi;
  /**
   * @var string[]
   */
  private array $alternativeNames;
  private string $title;

  public function __construct(
    int $physical,
    int $gpio = -1,
    int $wiringPi = -1,
    array $alternativeNames = [],
    string $title = ''
  ) {
    $this->physical         = $physical;
    $this->gpio             = $gpio;
    $this->wiringPi         = $wiringPi;
    $this->alternativeNames = $alternativeNames;
    $this->title            = $title;
  }

  public function getLogical(): int {
    return $this->physical - 1;
  }

  public function getPhysical(): int {
    return $this->physical;
  }

  public function getGpio(): int {
    return $this->gpio;
  }

  public function getWiringPi(): int {
    return $this->wiringPi;
  }

  public function getAlternativeNames(): array {
    return $this->alternativeNames;
  }

  public function getTitle(): string {
    return $this->title;
  }
}
