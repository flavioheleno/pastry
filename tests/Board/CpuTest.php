<?php
declare(strict_types = 1);

namespace Pastry\Test\Board;

use Pastry\Board\Cpu;

use PHPUnit\Framework\TestCase;

final class CpuTest extends TestCase {
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

    $cpu = Cpu::fromCpuInfo($info);

    $this->assertSame($properties[0], $cpu->getCount());
    $this->assertSame($properties[1], $cpu->getModelName());
    $this->assertSame($properties[2], $cpu->getBogoMips());
    $this->assertSame($properties[3], $cpu->getFeatures());
    $this->assertSame($properties[4], $cpu->getImplementer());
    $this->assertSame($properties[5], $cpu->getArchitecture());
    $this->assertSame($properties[6], $cpu->getVariant());
    $this->assertSame($properties[7], $cpu->getPart());
    $this->assertSame($properties[8], $cpu->getRevision());
  }

  public function propertiesDataProvider(): array {
    return [
      [
        '000e.txt',
        [
          1,
          'ARMv6-compatible processor rev 7 (v6l)',
          697.95,
          ['half', 'thumb', 'fastmult', 'vfp', 'edsp', 'java', 'tls'],
          0x41,
          7,
          0x0,
          0xb76,
          7
        ]
      ],
      [
        '9000c1.txt',
        [
          1,
          'ARMv6-compatible processor rev 7 (v6l)',
          697.95,
          ['half', 'thumb', 'fastmult', 'vfp', 'edsp', 'java', 'tls'],
          0x41,
          7,
          0x0,
          0xb76,
          7
        ]
      ],
      [
        'a020d3.txt',
        [
          4,
          'ARMv7 Processor rev 4 (v7l)',
          38.0,
          ['half', 'thumb', 'fastmult', 'vfp', 'edsp', 'neon', 'vfpv3', 'tls', 'vfpv4', 'idiva', 'idivt', 'vfpd32', 'lpae', 'evtstrm', 'crc32'],
          0x41,
          7,
          0x0,
          0xd03,
          4
        ]
      ],
      [
        'a21041.txt',
        [
          4,
          'ARMv7 Processor rev 5 (v7l)',
          38.40,
          ['half', 'thumb', 'fastmult', 'vfp', 'edsp', 'neon', 'vfpv3', 'tls', 'vfpv4', 'idiva', 'idivt', 'vfpd32', 'lpae', 'evtstrm'],
          0x41,
          7,
          0x0,
          0xc07,
          5
        ]
      ],
      [
        'd03114.txt',
        [
          4,
          'ARMv7 Processor rev 3 (v7l)',
          108.00,
          ['half', 'thumb', 'fastmult', 'vfp', 'edsp', 'neon', 'vfpv3', 'tls', 'vfpv4', 'idiva', 'idivt', 'vfpd32', 'lpae', 'evtstrm', 'crc32'],
          0x41,
          7,
          0x0,
          0xd08,
          3
        ]
      ]
    ];
  }
}
