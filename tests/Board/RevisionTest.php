<?php
declare(strict_types = 1);

namespace Pastry\Test\Board;

use Pastry\Board\Revision;

use PHPUnit\Framework\TestCase;
use RuntimeException;

final class RevisionTest extends TestCase {
  public function testFailure(): void {
    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('Failed to extract revision number from /proc/cpuinfo output');

    Revision::fromCpuInfo([]);
  }

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

    $revision = Revision::fromCpuInfo($info);

    $this->assertSame($properties[0], $revision->getReleaseDate());
    $this->assertSame($properties[1], $revision->getOvervoltage());
    $this->assertSame($properties[2], $revision->getOtpProgram());
    $this->assertSame($properties[3], $revision->getOtpRead());
    $this->assertSame($properties[4], $revision->getWarranty());
    $this->assertSame($properties[5], $revision->getNewFlag());
    $this->assertSame($properties[6], $revision->getMemorySize());
    $this->assertSame($properties[7], $revision->getManufacturer());
    $this->assertSame($properties[8], $revision->getProcessor());
    $this->assertSame($properties[9], $revision->getType());
    $this->assertSame($properties[10], $revision->getPcbRevision());
  }

  public function propertiesDataProvider(): array {
    return [
      ['000e.txt', ['Q4 2012', -1, -1, -1, -1, 0, 1, 0, -1, 1, 2.0]],
      ['9000c1.txt', ['Q1 2017', 0, 0, 0, 0, 1, 1, 0, 0, 12, 1.1]],
      ['a020d3.txt', ['Q1 2018', 0, 0, 0, 0, 1, 2, 0, 2, 13, 1.3]],
      ['a21041.txt', ['Q1 2015', 0, 0, 0, 0, 1, 2, 2, 1, 4, 1.1]],
      ['d03114.txt', ['Q2 2020', 0, 0, 0, 0, 1, 5, 0, 3, 17, 1.4]]
    ];
  }
}
