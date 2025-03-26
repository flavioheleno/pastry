# Pastry [![Maintainability](https://api.codeclimate.com/v1/badges/2a6fccf8032894f30507/maintainability)](https://codeclimate.com/github/flavioheleno/pastry/maintainability) [![Total Downloads](https://poser.pugx.org/flavioheleno/pastry/downloads)](//packagist.org/packages/flavioheleno/pastry)

Pastry is a handy tool to extract information from your [Raspberry Pi](https://www.raspberrypi.org/).

## Installation

To use Pastry, simple run:

```bash
composer require flavioheleno/pastry
```

## Usage

The Pastry library is super straightforward to use.

```php
/* Probe the system for information */
$pi = Pastry\Pi::probe();


/* Board details */
$board = $pi->getBoard();

$board->getHardware();
// string(7) "BCM2711"
$board->getRevision();
// string(6) "d03114"
$board->getSerial();
// string(16) "xxxxxxxxxxxxxxxx"
$board->getModel();
// string(30) "Raspberry Pi 4 Model B Rev 1.4"

/* CPU details */
$cpu = $pi->getCpu();

$cpu->getCount();
// int(4)
$cpu->getModelName();
// string(27) "ARMv7 Processor rev 3 (v7l)"
$cpu->getBogoMips();
// float(108)
$cpu->getFeatures();
// array(15) {
//   [0]  => string(4) "half"
//   [1]  => string(5) "thumb"
//   [2]  => string(8) "fastmult"
//   [3]  => string(3) "vfp"
//   [4]  => string(4) "edsp"
//   [5]  => string(4) "neon"
//   [6]  => string(5) "vfpv3"
//   [7]  => string(3) "tls"
//   [8]  => string(5) "vfpv4"
//   [9]  => string(5) "idiva"
//   [10] => string(5) "idivt"
//   [11] => string(6) "vfpd32"
//   [12] => string(4) "lpae"
//   [13] => string(7) "evtstrm"
//   [14] => string(5) "crc32"
// }
$cpu->getImplementer();
// int(65)
$cpu->getArchitecture();
// int(7)
$cpu->getVariant();
// int(0)
$cpu->getPart();
// int(3336)
$cpu->getRevision();
// int(3)

/* Revision details */
$revision = $pi->getRevision();

$revision->getReleaseDate();
// string(7) "Q2 2020"
$revision->getOvervoltage();
// int(0) - Overvoltage allowed
$revision->getOtpProgram();
// int(0) - OTP programming allowed
$revision->getOtpRead();
// int(0) - OTP reading allowed
$revision->getWarranty();
// int(0) - Warranty is intact
$revision->getNewFlag();
// int(1) - new-style revision
$revision->getMemorySize();
// int(5) - 8GB
$revision->getManufacturer();
// int(0) - Sony UK
$revision->getProcessor();
// int(3) - BCM2711
$revision->getType();
// int(17) - 4B
$revision->getPcbRevision();
// float(1.4)
```

## Supported Hardware

The table below lists the tested chips.

Revision                            | Model                               | Contributor
------------------------------------|-------------------------------------|------------
[000e](tests/Fixtures/000e.txt)     | Raspberry Pi Model B Rev 2          | [flavioheleno](https://github.com/flavioheleno)
[9000c1](tests/Fixtures/9000c1.txt) | Raspberry Pi Zero W Rev 1.1         | [flavioheleno](https://github.com/flavioheleno)
[902120](tests/Fixtures/902120.txt) | Raspberry Pi Zero 2 W Rev 1.0       | [okiedork](https://github.com/okiedork)
[a02082](tests/Fixtures/a02082.txt) | Raspberry Pi 3 Model B Rev 1.2      | [flavioheleno](https://github.com/flavioheleno)
[a020d3](tests/Fixtures/a020d3.txt) | Raspberry Pi 3 Model B Plus Rev 1.3 | [okiedork](https://github.com/okiedork)
[a21041](tests/Fixtures/a21041.txt) | Raspberry Pi 2 Model B Rev 1.1      | [okiedork](https://github.com/okiedork)
[c03115](tests/Fixtures/c03115.txt) | Raspberry Pi 4 Model B Rev 1.5      | [flavioheleno](https://github.com/flavioheleno)
[d03114](tests/Fixtures/d03114.txt) | Raspberry Pi 4 Model B Rev 1.4      | [flavioheleno](https://github.com/flavioheleno)
[d04170](tests/Fixtures/d04170.txt) | Raspberry Pi 5 Model B Rev 1.0      | [flavioheleno](https://github.com/flavioheleno)

If you have a Raspberry Pi and you don't see its model revision listed here, please consider contributing the contents of your `/proc/cpuinfo`.

## License

This library is licensed under the [MIT License](LICENSE).
