# Pastry

Pastry is a handy tool to extract information from your [Raspberry Pi](https://www.raspberrypi.org/).

## Installation

To use Pastry, simple run:

```bash
composer require flavioheleno/pastry
```

## Usage

The Pastry library is super straightforward to use.

```php
$pi = Pastry\Pi::probe();

/* Board details */
$pi->getBoard()->getHardware();
// string(7) "BCM2711"
$pi->getBoard()->getRevision();
// string(6) "d03114"
$pi->getBoard()->getSerial();
// string(16) "xxxxxxxxxxxxxxxx"
$pi->getBoard()->getModel();
// string(30) "Raspberry Pi 4 Model B Rev 1.4"

/* CPU details */
$pi->getCpu()->getCount();
// int(4)
$pi->getCpu()->getModelName();
// string(27) "ARMv7 Processor rev 3 (v7l)"
$pi->getCpu()->getBogoMips();
// float(108)
$pi->getCpu()->getFeatures();
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
$pi->getCpu()->getImplementer();
// int(65)
$pi->getCpu()->getArchitecture();
// int(7)
$pi->getCpu()->getVariant();
// int(0)
$pi->getCpu()->getPart();
// int(3336)
$pi->getCpu()->getRevision();
// int(3)

/* Revision details */
$pi->getRevision()->getReleaseDate();
// string(7) "Q2 2020"
$pi->getRevision()->getOvervoltage();
// int(0) - Overvoltage allowed
$pi->getRevision()->getOtpProgram();
// int(0) - OTP programming allowed
$pi->getRevision()->getOtpRead();
// int(0) - OTP reading allowed
$pi->getRevision()->getWarranty();
// int(0) - Warranty is intact
$pi->getRevision()->getNewFlag();
// int(1) - new-style revision
$pi->getRevision()->getMemorySize();
// int(5) - 8GB
$pi->getRevision()->getManufacturer();
// int(0) - Sony UK
$pi->getRevision()->getProcessor();
// int(3) - BCM2711
$pi->getRevision()->getType();
// int(17) - 4B
$pi->getRevision()->getPcbRevision();
// float(1.4)
```

## Supported Hardware

The table below lists the tested chips.

Revision                            | Model                               | Contributor
------------------------------------|-------------------------------------|------------
[000e](tests/Fixtures/000e.txt)     | Raspberry Pi Model B Rev 2          | [flavioheleno](https://github.com/flavioheleno)
[9000c1](tests/Fixtures/9000c1.txt) | Raspberry Pi Zero W Rev 1.1         | [flavioheleno](https://github.com/flavioheleno)
[a020d3](tests/Fixtures/a020d3.txt) | Raspberry Pi 3 Model B Plus Rev 1.3 | [okiedork](https://github.com/okiedork)
[a21041](tests/Fixtures/a21041.txt) | Raspberry Pi 2 Model B Rev 1.1      | [okiedork](https://github.com/okiedork)
[d03114](tests/Fixtures/d03114.txt) | Raspberry Pi 4 Model B Rev 1.4      | [flavioheleno](https://github.com/flavioheleno)

If you have a Raspberry Pi and you don't see its model revision listed here, please consider contributing the contents of your `/proc/cpuinfo`.

## License

This library is licensed under the [MIT License](LICENSE).
