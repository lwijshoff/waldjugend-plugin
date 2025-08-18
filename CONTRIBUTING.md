# Contributing Guide

Thanks for your interest in contributing! 🎉

This project uses **Conventional Commits** and automatically generates a `CHANGELOG.md` from commit history. To keep everything clean and automated, please follow these guidelines:

## How to Contribute

1. **Fork the repository** and clone your fork.
2. **Create a new branch** for your changes:
   ```bash
   git checkout -b feat/my-awesome-feature
   ```
3. Make your changes and commit with a proper message (see below).
4. Push your branch and open a **Pull Request**.

## Commit Message Format (Conventional Commits)

Please use the following structure for your commit messages:

```
<type>(optional scope): short description

[optional body]
```

### Examples:
- `feat: add dark mode toggle`
- `fix(navbar): resolve overlapping issue`
- `docs: update API usage in README`
- `chore: update dependencies`
- `refactor(auth): simplify login flow`

### Allowed types:
| Type       | Description                            |
|------------|----------------------------------------|
| `feat`     | New feature                            |
| `fix`      | Bug fix                                |
| `docs`     | Documentation changes                  |
| `style`    | Code style (formatting, no logic change) |
| `refactor` | Code restructure (no fix or feature)   |
| `perf`     | Performance improvements               |
| `test`     | Adding or fixing tests                 |
| `chore`    | Maintenance, build setup, CI, etc.     |
| `wip`      | Work-in-progress (used temporarily)    |

> [!TIP]
> If you're just testing things, use a commit like `wip: testing stuff`.

## Linting Commits (optional)

If you're working locally, you can use tools like [Husky](https://typicode.github.io/husky/) and [Commitlint](https://commitlint.js.org/#/) to validate your commits before they’re submitted.

## Auto-Generated Changelog

We use GitHub Actions to auto-generate the `CHANGELOG.md` file from commit history. Please make sure your commits follow the format above so your changes are properly documented.

Thanks again for contributing! 💚