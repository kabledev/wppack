# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

[0.3.0]: https://github.com/sivankanat/wppack/releases/tag/v0.3.0
[0.7.0]: https://github.com/sivankanat/wppack/releases/tag/v0.7.0

## [0.11.0] - 2021-06-20

### Added

- `Comments.php` Added custom comments.php template
- Added modules to `assets/src/scss`
- Added `get_summary` to `AppPosts`
- Added `metabox` to `app/parts`.
- Added sample tables to `metabox` direcotry

### Fixed

- Fixed `__dequeue_js` from app assets
- Fixed meta boxes from app custom post types
- Fixed registring custom post types from `AppCPT`

## [0.7.0] - 2021-06-1

### Added

- Added the dequeue property to the app.assets for remove unused files. see `app/app.assets.php`
- Added the get_items property to the app.menus. see `app/app.menus.php`
- Added the get_title and the display_title properties to the app.menus. see `app/app.menus.php`

### Changed

- Bug fixed from the add_static_pages
- Bug fixed from the get_menu_title
- Bug fixed from the server.js
- The static page publisher moved to the app.setup.php

## [0.3.0] - 2021-05-22

### important

- wpstarter changed to wppack see https://github.com/sivankanat/wpstarter

### Added

- Theme Options Panel

## [0.0.0] - 2021-05-22

### Added

- Lorem Ipsum
- Lorem Ipsum

### changed

- Lorem Ipsum
- Lorem Ipsum
