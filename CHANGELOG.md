# 📝  Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 2.1 - 17/02/2021
* Fixed : Javascript Error ([ Action stopped working #9 ](https://github.com/varunsridharan/action-repository-meta/issues/9)) 

## 2.0 - 16/11/2020
* Migrated To NodeJS To improve speed 

### New Variables
| ENV NAME |  Description | Example |
| :---: | --- | --- |
| `GITHUB_REF_SLUG` | The slug of the branch or tag ref that triggered the workflow (i.e. slug of `refs/heads/feat/feature-branch-1` ). If neither a branch or tag is available for the event type, the variable will not exist. | `refs-heads-feat-feature-branch-1` |
|`GITHUB_REF_NAME` | The branch or tag name that triggered the workflow. If neither a branch or tag is available for the event type, the variable will not exist. | `feat/feature-branch-1` |
|`GITHUB_REF_NAME_SLUG` | The slug of the branch or tag name that triggered the workflow. If neither a branch or tag is available for the event type, the variable will not exist. | `feat-feature-branch-1` |

## 1.4 - 28/10/2020
* Option to fetch meta data for custom repository

### New Variables
| ENV NAME |  Description | Example |
| :---: | --- | --- |
| `REPOSITORY_IS_ARCHIVED` | sets to **true** if its a archived repo | `true` |
| `REPOSITORY_IS_DISABLED` | sets to **true** if its a disabled repo | `true` |
| `REPOSITORY_IS_TEMPLATE` | sets to **true** if its a template repo | `true` |
| `OWNER_PROFILE` | Provides Github's Profile URL | `https://github.com/${REPOSITORY_OWNER}` |
| `REPOSITORY_CONTENTS_REPORTS_ENABLED` | Set to true if **Contents Reports** Enabled in the repository | `false` |
| `REPOSITORY_CODE_OF_CONDUCT_URL` | Provide **CODE_OF_CONDUCT.md** file's URL | `https://github.com/{owner}/{repo}/blob/{default_branch}/CODE_OF_CONDUCT.md` |
| `REPOSITORY_CONTRIBUTING_URL` | Provide **CONTRIBUTING.md** file's URL | `https://github.com/{owner}/{repo}/blob/{default_branch}/CONTRIBUTING.md` |
| `REPOSITORY_LICENSE` | Name of the LICENSE used in the repo | `MIT License` |
| `REPOSITORY_LICENSE_URL` | Provide **LICENSE** file's URL | `https://github.com/{owner}/{repo}/blob/{default_branch}/LICENSE` |
| `REPOSITORY_LICENSE_SLUG` | License's SLUG | `mit` |
| `REPOSITORY_LICENSE_SPDX_ID` | Name Based On [SPDX specification](https://spdx.org/) | `MIT` |
| `REPOSITORY_README_URL` | Provides **README.md** file's URL | `https://github.com/{owner}/{repo}/blob/{default_branch}/README.md` |
| `REPOSITORY_HAS_ISSUES` | Value set to **true** if  _ISSUES_ feature is enabled | `true` |
| `REPOSITORY_HAS_PROJECTS` | Value set to **true** if  _PROJECTS_ feature is enabled | `true` |
| `REPOSITORY_HAS_DOWNLOADS` | Value set to **true** if  _DOWNLOADS_ feature is enabled | `true` |
| `REPOSITORY_HAS_WIKI` | Value set to **true** if  _WIKI_ feature is enabled | `true` |
| `REPOSITORY_HAS_PAGES` | Value set to **true** if  _PAGES_ feature is enabled | `true` |

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