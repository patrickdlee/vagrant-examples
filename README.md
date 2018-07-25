# Vagrant Examples

## What is Vagrant?

Vagrant is an open-source software product for building and maintaining portable virtual software development environments. Vagrant supports the use of different configuration managment tools for managing the configuration of these environments. Much more information is available on the [Vagrant web site](http://www.vagrantup.com).

## What is this project?

This is a collection of sample Vagrant configurations using Puppet. They start out very simple with the bare minimum and gradually get more complex. The examples use Ubuntu 12.04, though they should work with any Debian-based Linux distribution. Other distros such as Fedora and SUSE could be supported with some Facter logic in the manifests to ensure that platform-specific packages are installed correctly (e.g. httpd vs apache2).

## How do I install Vagrant?

The host OS used in testing these examples was Mint 14 (Ubuntu-based), but any OS should work as long as VirtualBox can be installed. The Vagrant version used in these examples is v1.1.0. The [Vagrant download page](http://downloads.vagrantup.com/tags/v1.1.0) lists several options for installing v1.1.0.

## How do I run the examples?

From one of the example directories, type the following commands...

```
vagrant box add precise32 http://files.vagrantup.com/precise32.box
vagrant up
vagrant ssh
vagrant destroy
```

These commands will bring up the Vagrant box, SSH into it, and then remove it respectively.

## Summary of examples

1. Single box with some custom configuration.
2. Single box with VirtualBox provider.
3. Single box with VirtualBox provider and Puppet provisioning.
4. Single box with Apache and sample static site installed via Puppet.
5. Separate Web and database servers serving up static/dynamic sites via Puppet.
6. Pulling out all the stops with cluster of seven Vagrant boxes.
7. Single box with AWS provider and sample static/dynamic sites via Puppet.
