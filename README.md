# Vagrant Examples

## What is Vagrant?

Vagrant is a tool that uses Oracle's VirtualBox to dynamically build configurable, lightweight, and portable virtual machines. Vagrant supports the use of either Puppet or Chef for managing the configuration. Much more information is available on the [Vagrant web site](http://www.vagrantup.com).

## What is this project?

This is a collection of sample Vagrant configurations using Puppet. They start out very simple with the bare minimum and gradually get more complex. The examples use Ubuntu 12.04, though they should work with any Debian-based Linux distribution. Other distros such as Fedora and SUSE could be supported with some Facter logic in the manifests to ensure that platform-specific packages are installed correctly (e.g. httpd vs apache2).

## How do I install Vagrant?

The host OS used in testing these examples was Mint 14 (Ubuntu-based), but any OS should work as long as Ruby, RubyGems, and VirtualBox can be installed. Here is the installation procedure for Debian-based systems...

```
sudo apt-get install rubygems ruby1.9.1-dev virtualbox-4.2
sudo gem install vagrant
```

Yes, it's that simple. There are other ways to install Vagrant such as pre-built packages and stand-alone installers, but the examples in this project have been confirmed to work only with the Vagrant Ruby gem (v1.0.6). Your mileage may vary with other installation methods. The [Vagrant download page](http://downloads.vagrantup.com/tags/v1.0.6) lists several options for installing v1.0.6.

## How do I run the examples?

From one of the example directories, type the following commands...

```
vagrant up
vagrant ssh
```

