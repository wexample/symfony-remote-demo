# symfony-remote-demo

Version: 2.0.8

Demo remotes showing every state on the symfony-remote-ds screen

## Table of Contents

- [Introduction](#introduction)

`symfony-remote-demo` gives the showcase something to watch on the `symfony-remote-ds` screen: four demo remotes, one per state the screen must show — an answering service, a failing one, one missing its settings, and a slow one that answers after two seconds and holds only its own row. They are `DemoRemote` services declared in `src/Resources/config/services.yaml`; no request leaves the application.

Install it with `symfony-remote` and `symfony-remote-ds`, then open `/remote/` as an administrator.
