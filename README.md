# Newspaper Data Entry

A back-office data entry system for a newspaper. Staff record advertisements, cash book income and expenses, press materials, and circulation in one place, with per-module permissions. The data entry screens are in Bangla.

Built with Laravel 11 and [sebastienheyd/boilerplate](https://github.com/sebastienheyd/boilerplate) (AdminLTE).

## Modules

### Advertisement

- **আ/ন (A/N) and আ/স (A/S) registers:** subject, details, entry and print dates, amount, size, page, and comments, with a printable view
- **Advertisement panel:** organisation, campaign start and end dates, amount, paid date, and comments

### Cash book

- Named cash books with an opening (previous) balance
- Income and expense entries grouped under entry headings
- Running balance and a printable export for a date range

### Press

- **Paper:** rolls, roll weight, print order, wastage, and totals
- **Plate:** daily and new plates, advance paid, cut amount, and total plates
- **Ink:** colour, purchase date, quantity, amount, and when the ink ran out

### Circulation

- **Representatives:** name, email, mobile, and address
- **Monthly:** copies sent per district, monthly bill, paid and due amounts
- **Daily:** copy sales by buyer, quantity, and price

### Settings and access

- Time limits for how long after entry a record can still be edited or deleted
- Roles and permissions for each module and action (view, update, delete)
- User management, email verification, and themes from the boilerplate package

## Tech stack

| Layer    | Packages                                      |
| -------- | --------------------------------------------- |
| Backend  | PHP 8.2+, Laravel 11                          |
| Admin UI | sebastienheyd/boilerplate, AdminLTE, Laratrust |
| Tables   | Boilerplate Datatables                        |
| Tooling  | PHPUnit, Pint, Debugbar                       |

## Getting started

### Requirements

- PHP 8.2+
- Composer
- MySQL or another database supported by Laravel

### Installation

```bash
git clone https://github.com/mmrtonmoybd/newspaper-dataEntry.git
cd newspaper-dataEntry

composer install
cp .env.example .env
php artisan key:generate
# set the DB_* and MAIL_* values in .env
php artisan migrate --seed
php artisan storage:link
```

Open `/backend` and register the first account. The first user becomes the admin. Public registration is turned off after that (`config/boilerplate/auth.php`), so the admin adds other staff from the users screen and gives them roles.

### Run locally

```bash
php artisan serve
```

The admin area is at `http://localhost:8000/backend`.

## Testing and code style

```bash
php artisan test     # test suite
vendor/bin/pint      # fix PHP code style
```

## Author

Moshiur Rahman — [rmedha037@gmail.com](mailto:rmedha037@gmail.com)
