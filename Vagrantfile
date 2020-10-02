# -*- mode: ruby -*-
# vi: set ft=ruby :

# A Vagrantfile to set up three VMs, a webserver for client interaction,
# a webserver for admin display purposes and a database server,
# connected together using an internal network with manually-assigned
# IP addresses for the VMs.

class Hash
  def slice(*keep_keys)
    h = {}
    keep_keys.each { |key| h[key] = fetch(key) if has_key?(key) }
    h
  end unless Hash.method_defined?(:slice)
  def except(*less_keys)
    slice(*keys - less_keys)
  end unless Hash.method_defined?(:except)
end

Vagrant.configure("2") do |config|
  config.vm.box = "dummy"
  config.vm.provider :aws do |aws, override|

    # The region for Amazon Educate is fixed.
    aws.region = "us-east-1"

    override.nfs.functional = false
    override.vm.allowed_synced_folder_types = :rsync

    aws.keypair_name = "349asgn"
    override.ssh.private_key_path = "~/.ssh/349asgn.pem"

    aws.instance_type = "t2.micro"

    aws.security_groups = ["sg-07946052c68426ac7", "sg-0432d0d0262896a6b", "sg-0e61fb078f7207893"]

    aws.availability_zone = "us-east-1a"
    aws.subnet_id = "subnet-b2442fff"
    
    aws.ami = "ami-0f40c8f97004632f9"

    override.ssh.username = "ubuntu"
  end



  ## Front end web server.
  config.vm.define "webserver" do |webserver|

    webserver.vm.hostname = "webserver"
    webserver.vm.provision "shell", inline: <<-SHELL
      echo "Starting webserver"
      apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql
            
      cp /vagrant/client.conf /etc/apache2/sites-available/
      chmod 777 /vagrant
      chmod 777 /vagrant/www
      chmod 777 /vagrant/www/client
      chmod 777 /vagrant/www/client/index.php
      chmod 777 /vagrant/www/client/images/chair.png
      chmod 777 /vagrant/www/client/images/pan.png
      chmod 777 /vagrant/www/client/images/table.png
      chmod 777 /vagrant/www/client/images/toaster.png
      chmod 777 /vagrant/www/client/css/style.css
      chmod 777 /vagrant/www/client/js/cart.js
      chmod 777 /vagrant/www/client/js/shop.js
      chmod 777 /vagrant/www/client/js/jquery-3.5.1.min.js
      a2ensite client
      a2dissite 000-default
      service apache2 reload
    SHELL
  end

  ## Used by webserver administrator to track orders / modify products.
  config.vm.define "adminserver" do |adminserver|
    adminserver.vm.hostname = "webserver"
    adminserver.vm.provision "shell", inline: <<-SHELL
      echo "Starting admin server"
      apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql
            
      cp /vagrant/admin.conf /etc/apache2/sites-available/

      chmod 777 /vagrant
      chmod 777 /vagrant/www
      chmod 777 /vagrant/www/admin
      chmod 777 /vagrant/www/admin/index.php
      chmod 777 /vagrant/www/admin/css/style.css
      chmod 777 /vagrant/www/admin/js/ship.js
      chmod 777 /vagrant/www/admin/js/jquery-3.5.1.min.js

      a2ensite admin
      a2dissite 000-default
      service apache2 reload
    SHELL
  end

end
