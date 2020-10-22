# 📝  Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 1.3.2 - 22/10/2020
### Changed
* Updated Docker Image From `php:cli-alpine` to `varunsridharan/actions-alpine-php:latest`

## 1.3.1 - 18/10/2020
### New Repository Commits Related Variables
| ENV NAME | Description | Example |
| :---: | --- | --- |
|`RELEASE_VERSION` | provides branch name which is set as default | `Branch` OR `Comment Hash` OR `Version Number` |


## 1.3 - 18/10/2020
### New Repository Related Variables
| ENV NAME | Description | Example |
| --- | --- | --- |
| `REPOSITORY_GIT_URL` | Provides Repository GIT URL | `git://github.com/xxx/xxx.git` |
| `REPOSITORY_SSH_URL` | Provides Repository SSH URL | `git@github.com:xxx/xxx.git` |
| `REPOSITORY_WATCHERS_COUNT` | Provides Repository Watchers Count | `0` |
| `REPOSITORY_STARGAZERS_COUNT` | Provides Repository Stars Count | `0` |
| `REPOSITORY_FORKS_COUNT` | Provides Repository Forks Count | `0` |
| `REPOSITORY_OWNER` | Extracts Owner Name For The Current Repository | `myname/test-repo` => `myname` |
| `OWNER_PROFILE` | Provides Github's Profile URL | `https://github.com/${REPOSITORY_OWNER}` |
| `OWNER_TYPE` | Value is set to `Organization` if current repository belongs to a **Organization** if not its set to **User** | `Organization` / `User` |
| `IS_OWNER_ORGANIZATION` |Set to `Yes` or `No` Based on `OWNER_TYPE` value  | `no` |
| `IS_OWNER_USER` | Set to `Yes` or `No` Based on `OWNER_TYPE` value | `yes` |

## 1.2 - 10/10/2020
### Fixed
* [ moderate security vulnerability](https://github.blog/changelog/2020-10-01-github-actions-deprecating-set-env-and-add-path-commands/) 
> `set-env` removed the usage and migrated to new [environment files](https://docs.github.com/en/free-pro-team@latest/actions/reference/workflow-commands-for-github-actions#environment-files)

## 1.1 - 06/07/2020
### Added
* Repository Topics Are now available as ENV Variable `REPOSITORY_TOPICS`

## 1.0 - 02/07/2020
### First Release

<!--
Template
## Unreleased
### Added

### Changed

### Deprecated

### Removed

### Fixed

### Security
-->