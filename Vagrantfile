# -*- mode: ruby -*-
# vi: set ft=ruby :

# A Vagrantfile to set up three VMs, a webserver for client interaction,
# a webserver for admin display purposes and a database server,
# connected together using an internal network with manually-assigned
# IP addresses for the VMs.

Vagrant.configure("2") do |config|
  # Box previously used in labs, so reusing it here should save a
  # bit of time by using a cached copy.

  config.vm.box = "ubuntu/xenial64"

  ## Front end web server.
  config.vm.define "webserver" do |webserver|
    
    # These are options specific to the webserver VM.
    webserver.vm.hostname = "webserver"
    
    # The port forwrading here allows our host computer to be able to
    # connect to IP address 127.0.0.1 port 8080, and that network
    # request will reach our webserver VM's port 80.

    webserver.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
    
    # We set up a private network that our VMs will use to communicate
    # with each other.

    webserver.vm.network "private_network", ip: "192.168.2.11"

    # CS Lab permissions for shared Vagrant folder.
    webserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    # Specifying the shell commands to provision the webserver VM.
    webserver.vm.provision "shell", inline: <<-SHELL
      echo "Starting webserver"
      apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql
            
      # Change VM's webserver's configuration to use shared folder.
      # (Look inside test-website.conf for specifics.)
      cp /vagrant/client.conf /etc/apache2/sites-available/
      # activate our website configuration ...
      a2ensite client
      # ... and disable the default website provided with Apache
      a2dissite 000-default
      # Reload the webserver configuration, to pick up our changes
      service apache2 reload
    SHELL
  end

  ## Used to store products, administrator login credentials and orders.
  config.vm.define "dbserver" do |dbserver|
    dbserver.vm.hostname = "dbserver"
    
    # No VMs should attempt to use the same IP address
    # on the private_network as the other.
    dbserver.vm.network "private_network", ip: "192.168.2.12"
    dbserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]
    
    dbserver.vm.provision "shell", inline: <<-SHELL
      # Update Ubuntu software packages.
      apt-get update
      
      # We create a shell variable MYSQL_PWD that contains the MySQL root password
      export MYSQL_PWD='insecure_mysqlroot_pw'

      echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections 
      echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections

      apt-get -y install mysql-server

      echo "CREATE DATABASE fvision;" | mysql

      echo "CREATE USER 'webuser'@'%' IDENTIFIED BY 'insecure_db_pw';" | mysql

      echo "GRANT ALL PRIVILEGES ON fvision.* TO 'webuser'@'%'" | mysql
      export MYSQL_PWD='insecure_db_pw'

      # run database setup
      cat /vagrant/setup-database.sql | mysql -u webuser fvision

      sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf
      service mysql restart
    SHELL
  end

  ## Used by webserver administrator to track orders / modify products.
  config.vm.define "adminserver" do |adminserver|
    adminserver.vm.hostname = "webserver"
    adminserver.vm.network "forwarded_port", guest: 80, host: 8081, host_ip: "127.0.0.1"
    adminserver.vm.network "private_network", ip: "192.168.2.13"
    adminserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    adminserver.vm.provision "shell", inline: <<-SHELL
      echo "Starting admin server"
      apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql
            
      # Change VM's webserver's configuration to use shared folder.
      # (Look inside test-website.conf for specifics.)
      cp /vagrant/admin.conf /etc/apache2/sites-available/
      # activate our website configuration ...
      a2ensite admin
      # ... and disable the default website provided with Apache
      a2dissite 000-default
      # Reload the webserver configuration, to pick up our changes
      service apache2 reload
    SHELL
  end
end
