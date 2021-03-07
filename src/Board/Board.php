<?php
declare(strict_types = 1);

namespace Pastry\Board;

final class Board {
  private string $hardware;
  private string $revision;
  private string $serial;
  private string $model;

  private function __construct(
    string $hardware,
    string $revision,
    string $serial,
    string $model
  ) {
    $this->hardware = $hardware;
    $this->revision = $revision;
    $this->serial   = $serial;
    $this->model    = $model;
  }

  public static function fromCpuInfo(array $info): static {
    $hardware = '';
    $revision = '';
    $serial = '';
    $model = '';

    foreach ($info as $line) {
      if (preg_match('/^hardware *: (.*)$/i', $line, $match) === 1) {
        $hardware = $match[1];

        continue;
      }

      if (preg_match('/^revision *: (.*)$/i', $line, $match) === 1) {
        $revision = $match[1];

        continue;
      }

      if (preg_match('/^serial *: (.*)$/i', $line, $match) === 1) {
        $serial = $match[1];

        continue;
      }

      if (preg_match('/^model *: (.*)$/i', $line, $match) === 1) {
        $model = $match[1];
      }
    }

    return new static($hardware, $revision, $serial, $model);
  }

  public function getHardware(): string {
    return $this->hardware;
  }

  public function getRevision(): string {
    return $this->revision;
  }

  public function getSerial(): string {
    return $this->serial;
  }

  public function getModel(): string {
    return $this->model;
  }
}
