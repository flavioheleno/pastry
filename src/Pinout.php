<?php
declare(strict_types = 1);

namespace Pastry;

use InvalidArgumentException;
use Pastry\Pin\Pin;
use RuntimeException;

final class Pinout {
  private const REFERENCE = [
    /**
     * @link https://pinout.xyz/pinout/3v3_power
     */
    [1, -1, -1, ['3V3 POWER'], '3v3 Power'],
    /**
     * @link https://pinout.xyz/pinout/5v_power
     */
    [2, -1, -1, ['5V POWER'], '5v Power'],
    /**
     * @link https://pinout.xyz/pinout/pin3_gpio2
     */
    [
      3,
      2,
      8,
      [
        'I2C1 SDA',
        'SMI SA3',
        'DPI VSYNC',
        'AVEOUT VSYNC',
        'AVEIN VSYNC'
      ],
      'I2C Data'
    ],
    /**
     * @link https://pinout.xyz/pinout/5v_power
     */
    [4, -1, -1, ['5V POWER'], '5v Power'],
    /**
     * @link https://pinout.xyz/pinout/pin5_gpio3
     */
    [
      5,
      3,
      9,
      [
        'I2C1 SCL',
        'SMI SA2',
        'DPI HSYNC',
        'AVEOUT HSYNC',
        'AVEIN HSYNC'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/ground
     */
    [6, -1, -1, ['GROUND'], 'Ground'],
    /**
     * @link https://pinout.xyz/pinout/pin7_gpio4
     */
    [
      7,
      4,
      7,
      [
        'GPCLK0',
        'SMI SA1',
        'DPI D0',
        'AVEOUT VID0',
        'AVEIN VID0',
        'JTAG TDI'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/pin8_gpio14
     */
    [
      8,
      14,
      15,
      [
        'UART0 TXD',
        'SMI SD6',
        'DSI D10',
        'AVEOUT VID10',
        'AVEIN VID10',
        'UART1 TXD'
      ],
      'UART Transmit'
    ],
    /**
     * @link https://pinout.xyz/pinout/ground
     */
    [9, -1, -1, ['GROUND'], 'Ground'],
    /**
     * @link https://pinout.xyz/pinout/pin10_gpio15
     */
    [
      10,
      15,
      16,
      [
        'UART0 RXD',
        'SMI SD7',
        'DPI D11',
        'AVEOUT VID11',
        'AVEIN VID11',
        'UART1 RXD'
      ],
      'UART Receive'
    ],
    /**
     * @link https://pinout.xyz/pinout/pin11_gpio17
     */
    [
      11,
      17,
      0,
      [
        'FL1',
        'SMI SD9',
        'DPI D13',
        'UART0 RTS',
        'SPI1 CE1',
        'UART1 RTS'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/pin12_gpio18
     */
    [
      12,
      18,
      1,
      [
        'PCM CLK',
        'SMI SD10',
        'DPI D14',
        'I2CSL SDA / MOSI',
        'SPI1 CE0',
        'PWM0'
      ],
      'PCM Clock'
    ],
    /**
     * @link https://pinout.xyz/pinout/pin13_gpio27
     */
    [
      13,
      27,
      2,
      [
        'SD0 DAT3',
        'TE1',
        'DPI D23',
        'SD1 DAT3',
        'JTAG TMS'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/ground
     */
    [14, -1, -1, ['GROUND'], 'Ground'],
    /**
     * @link https://pinout.xyz/pinout/pin15_gpio22
     */
    [
      15,
      22,
      3,
      [
        'SD0 CLK',
        'SMI SD14',
        'DPI D18',
        'SD1 CLK',
        'JTAG TRST'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/pin16_gpio23
     */
    [
      16,
      23,
      4,
      [
        'SD0 CMD',
        'SMI SD15',
        'DPI D19',
        'SD1 CMD',
        'JTAG RTCK'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/3v3_power
     */
    [17, -1, -1, ['3V3 POWER'], '3v3 Power'],
    /**
     * @link https://pinout.xyz/pinout/pin18_gpio24
     */
    [
      18,
      24,
      5,
      [
        'SD0 DAT0',
        'SMI SD16',
        'DPI D20',
        'SD1 DAT0',
        'JTAG TDO'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/pin19_gpio10
     */
    [
      19,
      10,
      12,
      [
        'SPI0 MOSI',
        'SMI SD2',
        'DPI D6',
        'AVEOUT VID6',
        'AVEIN VID6'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/ground
     */
    [20, -1, -1, ['GROUND'], 'Ground'],
    /**
     * @link https://pinout.xyz/pinout/pin21_gpio9
     */
    [
      21,
      9,
      13,
      [
        'SPI0 MISO',
        'SMI SD1',
        'DPI D5',
        'AVEOUT VID5',
        'AVEIN VID5'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/pin22_gpio25
     */
    [
      22,
      25,
      6,
      [
        'SD0 DAT1',
        'SMI SD17',
        'DPI D21',
        'SD1 DAT1',
        'JTAG TCK'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/pin23_gpio11
     */
    [
      23,
      11,
      14,
      [
        'SPI0 SCLK',
        'SMI SD3',
        'DPI D7',
        'AVEOUT VID7',
        'AVEIN VID7'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/pin24_gpio8
     */
    [
      24,
      8,
      10,
      [
        'SPI0 CE0',
        'SMI SD0',
        'DPI D4',
        'AVEOUT VID4',
        'AVEIN VID4'
      ],
      'SPI Chip Select 0'
    ],
    /**
     * @link https://pinout.xyz/pinout/ground
     */
    [25, -1, -1, ['GROUND'], 'Ground'],
    /**
     * @link https://pinout.xyz/pinout/pin26_gpio7
     */
    [
      26,
      7,
      11,
      [
        'SPI0 CE1',
        'SMI SWE_N / SRW_N',
        'DPI D3',
        'AVEOUT VID3',
        'AVEIN VID3'
      ],
      'SPI Chip Select 1'
    ],
    /**
     * @link https://pinout.xyz/pinout/pin27_gpio0
     */
    [
      27,
      0,
      30,
      [
        'I2C0 SDA',
        'SMI SA5',
        'DPI CLK',
        'AVEOUT VCLK',
        'AVEIN VCLK'
      ],
      'HAT EEPROM i2c Data'
    ],
    /**
     * @link https://pinout.xyz/pinout/pin28_gpio1
     */
    [
      28,
      1,
      31,
      [
        'I2C0 SCL',
        'SMI SA4',
        'DPI DEN',
        'AVEOUT DSYNC',
        'AVEIN DSYNC'
      ],
      'HAT EEPROM i2c Clock'
    ],
    /**
     * @link https://pinout.xyz/pinout/pin29_gpio5
     */
    [
      29,
      5,
      21,
      [
        'GPCLK1',
        'SMI SA0',
        'DPI D1',
        'AVEOUT VID1',
        'AVEIN VID1',
        'JTAG TDO'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/ground
     */
    [30, -1, -1, ['GROUND'], 'Ground'],
    /**
     * @link https://pinout.xyz/pinout/pin31_gpio6
     */
    [
      31,
      6,
      22,
      [
        'GPCLK2',
        'SMI SOE_N / SE',
        'DPI D2',
        'AVEOUT VID2',
        'AVEIN VID2',
        'JTAG RTCK'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/pin32_gpio12
     */
    [
      32,
      12,
      26,
      [
        'PWM0',
        'SMI SD4',
        'DPI D8',
        'AVEOUT VID8',
        'AVEIN VID8',
        'JTAG TMS'
      ],
      'PWM0'
    ],
    /**
     * @link https://pinout.xyz/pinout/pin33_gpio13
     */
    [
      33,
      13,
      23,
      [
        'PWM1',
        'SMI SD5',
        'DPI D9',
        'AVEOUT VID9',
        'AVEIN VID9',
        'JTAG TCK'
      ],
      'PWM1'
    ],
    /**
     * @link https://pinout.xyz/pinout/ground
     */
    [34, -1, -1, ['GROUND'], 'Ground'],
    /**
     * @link https://pinout.xyz/pinout/pin35_gpio19
     */
    [
      35,
      19,
      24,
      [
        'PCM FS',
        'SMI SD11',
        'DPI D15',
        'I2CSL SCL / SCLK',
        'SPI1 MISO',
        'PWM1'
      ],
      'PCM Frame Sync'
    ],
    /**
     * @link https://pinout.xyz/pinout/pin36_gpio16
     */
    [
      26,
      16,
      27,
      [
        'FL0',
        'SMI SD8',
        'DPI D12',
        'UART0 CTS',
        'SPI1 CE2',
        'UART1 CTS'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/pin37_gpio26
     */
    [
      37,
      26,
      25,
      [
        'SD0 DAT2',
        'TE0',
        'DPI D22 ',
        'SD1 DAT2',
        'JTAG TDI'
      ]
    ],
    /**
     * @link https://pinout.xyz/pinout/pin38_gpio20
     */
    [
      38,
      20,
      28,
      [
        'PCM DIN',
        'SMI SD12',
        'DPI D16',
        'I2CSL MISO',
        'SPI1 MOSI',
        'GPCLK0'
      ],
      'PCM Data-In'
    ],
    /**
     * @link https://pinout.xyz/pinout/ground
     */
    [39, -1, -1, ['GROUND'], 'Ground'],
    /**
     * @link https://pinout.xyz/pinout/pin40_gpio21
     */
    [
      40,
      21,
      29,
      [
        'PCM DOUT',
        'SMI SD13',
        'DPI D17',
        'I2CSL CE',
        'SPI1 SCLK',
        'GPCLK1'
      ],
      'PCM Data-Out'
    ]
  ];

  private static function searchReference(int $index, int $pin): array {
    assert(
      $pin > 0,
      new InvalidArgumentException('$pin must be greater than 0')
    );

    return array_filter(
      self::REFERENCE,
      function (array $ref) use ($index, $pin): bool {
        return $ref[$index] === $pin;
      }
    );
  }

  public static function fromPhysical(int $pin): Pin {
    $item = self::searchReference(0, $pin);

    if (count($item) === 0) {
      throw new RuntimeException(
        sprintf(
          'Could not find pin "%d" from Physical list',
          $pin
        )
      );
    }

    return new Pin(...array_pop($item));
  }

  public static function fromGpio(int $pin): Pin {
    $item = self::searchReference(1, $pin);

    if (count($item) === 0) {
      throw new RuntimeException(
        sprintf(
          'Could not find pin "%d" from GPIO list',
          $pin
        )
      );
    }

    return new Pin(...array_pop($item));
  }

  public static function fromBcm(int $pin): Pin {
    $item = self::searchReference(1, $pin);

    if (count($item) === 0) {
      throw new RuntimeException(
        sprintf(
          'Could not find pin "%d" from BCM list',
          $pin
        )
      );
    }

    return new Pin(...array_pop($item));
  }

  public static function fromWiringPi(int $pin): Pin {
    $item = self::searchReference(2, $pin);

    if (count($item) === 0) {
      throw new RuntimeException(
        sprintf(
          'Could not find pin "%d" from WiringPi list',
          $pin
        )
      );
    }

    return new Pin(...array_pop($item));
  }
}
