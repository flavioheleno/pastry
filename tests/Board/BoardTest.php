<?php
declare(strict_types = 1);

namespace Pastry\Test\Board;

use Pastry\Board\Board;

use PHPUnit\Framework\TestCase;

final class BoardTest extends TestCase {
  /**
   * @dataProvider propertiesDataProvider
   */
  public function testProperties(string $filePath, array $properties): void {
    $info = array_map(
      function (string $line) {
        return trim(str_replace("\t", ' ', $line));
      },
      file(__DIR__ . '/../Fixtures/' . $filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
    );

    $board = Board::fromCpuInfo($info);

    $this->assertSame($properties[0], $board->getHardware());
    $this->assertSame($properties[1], $board->getRevision());
    $this->assertSame($properties[2], $board->getSerial());
    $this->assertSame($properties[3], $board->getModel());
  }

  public function propertiesDataProvider(): array {
    return [
      [
        '000e.txt',
        [
          'BCM2835',
          '000e',
          'xxxxxxxxxxxxxxxx',
          'Raspberry Pi Model B Rev 2'
        ]
      ],
      [
        '9000c1.txt',
        [
          'BCM2835',
          '9000c1',
          'xxxxxxxxxxxxxxxx',
          'Raspberry Pi Zero W Rev 1.1'
        ]
      ],
      [
        'a020d3.txt',
        [
          'BCM2835',
          'a020d3',
          'xxxxxxxxxxxxxxxx',
          'Raspberry Pi 3 Model B Plus Rev 1.3'
        ]
      ],
      [
        'a21041.txt',
        [
          'BCM2835',
          'a21041',
          'xxxxxxxxxxxxxxxx',
          ''
        ]
      ],
      [
        'd03114.txt',
        [
          'BCM2711',
          'd03114',
          'xxxxxxxxxxxxxxxx',
          'Raspberry Pi 4 Model B Rev 1.4'
        ]
      ],
    ];
  }
}
