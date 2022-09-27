# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "dummy"
  config.vm.provider :aws do |aws, override|

    aws.region = "us-east-1"

    override.nfs.functional = false
    override.vm.allowed_synched_folder_types = :rsynch

    aws.keypair_name = "a2key"

    # add this file via laptop
    override.ssh.private_key_path = "~/.ssh/a2key.pem"

    aws.instance_type = "t2.micro"

    aws.security_group = "sg-04c55a0e57ddf5ea0"

    aws.availability.zone = "us-east-1a"
    aws.subnet_id = "subnet-00bc365d464af3faf"

    aws.ami = "ami-0b0ea68c435eb488d"

    override.ssh.username = "ubuntu"
  
  
      # Currency Web Server
      config.vm.define "webserver" do |webserver|
        webserver.vm.hostname = "webserver-tz"
        webserver.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
        webserver.vm.network "private_network", ip: "192.168.2.11"
        webserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]
        webserver.vm.provision "shell", inline: <<-SHELL
           apt-get update
                apt-get install -y apache2 php libapache2-mod-php php-mysql
                cp /vagrant/test-website.conf /etc/apache2/sites-available/
                a2ensite test-website    
                a2dissite 000-default
                service apache2 reload22
            SHELL
      end

      #Currency converter database
        config.vm.define "databaseserver" do |databaseserver|
    
      databaseserver.vm.hostname = "databaseserver-cc"
      
      databaseserver.vm.network "private_network", ip: "192.168.2.12"
      databaseserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]
      
      databaseserver.vm.provision "shell", inline: <<-SHELL
        apt-get update
        export MYSQL_PWD='root123'
        echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections 
        echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections
        apt-get -y install mysql-server
        echo "CREATE DATABASE currencies;" | mysql
        echo "CREATE DATABASE kounters;" | mysql
        echo "CREATE USER 'user'@'%' IDENTIFIED BY 'root123';" | mysql
        echo "GRANT ALL PRIVILEGES ON currencies.* TO 'user'@'%'" | mysql
        echo "GRANT ALL PRIVILEGES ON kounters.* TO 'user'@'%'" | mysql
        #export MYSQL_PWD='root123'
        cat /vagrant/database-cc-setup-currencies.sql | mysql -u user currencies
        cat /vagrant/database-cc-setup-counters.sql | mysql -u user kounters
        sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf
        service mysql restart
      SHELL
    end


    # Admin Web Server
    config.vm.define "admin" do |admin|
    admin.vm.hostname = "admin"

    admin.vm.network "forwarded_port", guest: 80, host: 8081, host_ip: "127.0.0.1"
    admin.vm.network "private_network", ip: "192.168.2.13"

    admin.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"] 
            
    
    admin.vm.provision "shell", inline: <<-SHELL
                          apt-get update
                          apt-get install -y apache2 php libapache2-mod-php php-mysql
                          cp /vagrant/admin-website.conf /etc/apache2/sites-available/
                          a2ensite admin-website
                          a2dissite 000-default
                          service apache2 reload
                  SHELL
   end
  
  end
