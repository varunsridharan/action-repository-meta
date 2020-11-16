<p align="center"><img src="https://cdn.svarun.dev/gh/actions-small.png" width="150px"/></p>

# Repository Meta - ***Github Action***
Github Action exposes useful metadata as environment variable which can be called / used in a workflow 
 
## 📥 ENV Variable
Below listed variables are set by this action when used

### Repository Basic Information Variables
| ENV NAME |  Description | Example |
| :---: | --- | --- |
|`REPOSITORY_FULL_NAME`| provide exact repo name | `myname/test-repo` |
|`REPOSITORY_SLUG`| provide exact slug for current repo | `myname/test-repo` => `test-repo` |
|`REPOSITORY_NAME` | provide readable name | `test-repo` => `Test Repo` |
|`REPOSITORY_DESCRIPTION` | provides value which is set in repo settings | `Your Custom Description` |
|`REPOSITORY_CREATED_AT` | provides created at date | `2020-06-03T07:57:39Z` |
|`REPOSITORY_UPDATED_AT` | provides updated at date | `2020-07-02T07:01:30Z` |
|`REPOSITORY_PUSHED_AT` | provides pushed at date | `2020-07-02T07:01:28Z` |
|`REPOSITORY_DEFAULT_BRANCH` | provides branch name which is set as default | `master` |
| `GITHUB_REF_SLUG` | The slug of the branch or tag ref that triggered the workflow (i.e. slug of `refs/heads/feat/feature-branch-1` ). If neither a branch or tag is available for the event type, the variable will not exist. | `refs-heads-feat-feature-branch-1` |
|`GITHUB_REF_NAME` | The branch or tag name that triggered the workflow. If neither a branch or tag is available for the event type, the variable will not exist. | `feat/feature-branch-1` |
|`GITHUB_REF_NAME_SLUG` | The slug of the branch or tag name that triggered the workflow. If neither a branch or tag is available for the event type, the variable will not exist. | `feat-feature-branch-1` |
|`SHA_SHORT` | The shortened commit SHA (8 characters) that triggered the workflow. | `ffac537e` |
|`RELEASE_VERSION`* | provides branch name which is set as default |`Branch` OR `Comment Hash` OR `Version Number` |
|`REPOSITORY_TOPICS` | provides current repository topics | `["topic1","topic2"]` |

> * USING `RELEASE_VERSION` in normal comment will provide **Commit Hash** and if used in a taged version then it will provide the tag value **vX.X.X**

### Repository Community Variables
| ENV NAME |  Description | Example |
| :---: | --- | --- |
| `REPOSITORY_CONTENTS_REPORTS_ENABLED` | Set to true if **Contents Reports** Enabled in the repository | `false` |
| `REPOSITORY_CODE_OF_CONDUCT_URL` | Provide **CODE_OF_CONDUCT.md** file's URL | `https://github.com/{owner}/{repo}/blob/{default_branch}/CODE_OF_CONDUCT.md` |
| `REPOSITORY_CONTRIBUTING_URL` | Provide **CONTRIBUTING.md** file's URL | `https://github.com/{owner}/{repo}/blob/{default_branch}/CONTRIBUTING.md` |
| `REPOSITORY_LICENSE` | Name of the LICENSE used in the repo | `MIT License` |
| `REPOSITORY_LICENSE_URL` | Provide **LICENSE** file's URL | `https://github.com/{owner}/{repo}/blob/{default_branch}/LICENSE` |
| `REPOSITORY_LICENSE_SLUG` | License's SLUG | `mit` |
| `REPOSITORY_LICENSE_SPDX_ID` | Name Based On [SPDX specification](https://spdx.org/) | `MIT` |
| `REPOSITORY_README_URL` | Provides **README.md** file's URL | `https://github.com/{owner}/{repo}/blob/{default_branch}/README.md` |

### Repository Count's Information Variables
| ENV NAME |  Description | Example |
| :---: | --- | --- |
|`REPOSITORY_WATCHERS_COUNT` | Provides Repository Watchers Count | `0` |
|`REPOSITORY_STARGAZERS_COUNT` | Provides Repository Stars Count | `0` |
|`REPOSITORY_FORKS_COUNT` | Provides Repository Forks Count | `0` |

### Repository Features Variable
| ENV NAME |  Description | Example |
| :---: | --- | --- |
| `REPOSITORY_HAS_ISSUES` | Value set to **true** if  _ISSUES_ feature is enabled | `true` |
| `REPOSITORY_HAS_PROJECTS` | Value set to **true** if  _PROJECTS_ feature is enabled | `true` |
| `REPOSITORY_HAS_DOWNLOADS` | Value set to **true** if  _DOWNLOADS_ feature is enabled | `true` |
| `REPOSITORY_HAS_WIKI` | Value set to **true** if  _WIKI_ feature is enabled | `true` |
| `REPOSITORY_HAS_PAGES` | Value set to **true** if  _PAGES_ feature is enabled | `true` |

### Repository Status Variables
| ENV NAME |  Description | Example |
| :---: | --- | --- |
|`REPOSITORY_IS_PRIVATE` | sets to **true** if its a private repo | `true` |
|`REPOSITORY_IS_FORK` | sets to **true** if its a forked repo | `true` |
|`REPOSITORY_IS_TEMPLATE` | sets to **true** if its a template repo | `true` |
|`REPOSITORY_IS_ARCHIVED` | sets to **true** if its a archived repo | `true` |
|`REPOSITORY_IS_DISABLED` | sets to **true** if its a disabled repo | `true` |

### Repository Owner Variables
| ENV NAME |  Description | Example |
| :---: | --- | --- |
|`REPOSITORY_OWNER` | Extracts Owner Name For The Current Repository | `myname/test-repo` => `myname` |
|`OWNER_PROFILE` | Provides Github's Profile URL | `https://github.com/${REPOSITORY_OWNER}` |
|`OWNER_AVATAR_URL` | Provides Github's Avatar URL | `` |
|`OWNER_TYPE` | Value is set to `Organization` if current repository belongs to a **Organization** if not its set to **User** | `Organization` / `User` |
|`IS_OWNER_ORGANIZATION` |Set to `true` or `false` Based on `OWNER_TYPE` value  | `false` |
|`IS_OWNER_USER` | Set to `true` or `false` Based on `OWNER_TYPE` value | `true` |

### Repository URL Variables
| ENV NAME | Description | Example |
| :---: | --- | --- |
|`REPOSITORY_GITHUB_URL` | provides github url for current repo | `https://github.com/myname/test-repo` |
|`REPOSITORY_HOMEPAGE_URL` | provides url which is set in repo settings | `https://your-website.com` |
|`REPOSITORY_GIT_URL` | Provides Repository GIT URL | `git://github.com/xxx/xxx.git` |
|`REPOSITORY_SSH_URL` | Provides Repository SSH URL | `git@github.com:xxx/xxx.git` | 

## 🚀 Usage
<!-- START RAW -->
### Fetch Meta Information For Current Repository
```yaml
  - name: "Repository Meta"
    uses: varunsridharan/action-repository-meta@main
    env:
      GITHUB_TOKEN: ${{ secrets.GITHUB_TOKEN }}
  - run: echo $REPOSITORY_HOMEPAGE_URL
    env:
      REPOSITORY_HOMEPAGE_URL: ${{ env.REPOSITORY_HOMEPAGE_URL }}
```
### Fetch Meta Information For Custom Repository
```yaml
  - name: "Repository Meta"
    uses: varunsridharan/action-repository-meta@main
    with:
      REPOSITORY: octocat/Hello-World
    env:
      GITHUB_TOKEN: ${{ secrets.GITHUB_TOKEN }}
  - run: echo $REPOSITORY_HOMEPAGE_URL
    env:
      REPOSITORY_HOMEPAGE_URL: ${{ env.REPOSITORY_HOMEPAGE_URL }}
```
<!-- END RAW -->

---

<!-- START common-footer.mustache -->

<!-- END common-footer.mustache -->