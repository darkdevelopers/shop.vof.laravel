# Install Project

Install the Developer Instance from this VOF Shop.

---
- [create bitbucket account](/{{route}}/{{version}}/install-project#create-bitbucket-account)
- [install Docker](/{{route}}/{{version}}/install-project#install-docker)
- [configure your local pc](/{{route}}/{{version}}/install-project#configure-your-local-pc)
- [install git & git-flow](/{{route}}/{{version}}/install-project#install-git)
- [install Shop](/{{route}}/{{version}}/install-project#install-shop)


<a name="create-bitbucket-account">

## \#create bitbucket account

Go to https://bitbucket.org and create an account with your Company Mail Adresse.
Your E-Mail can you send Marco for joining the Projectteam.

<a name="install-docker">

## \#install docker
Docker is an container service, to make visual containers. Its shortly sayed an VM Software but nicer...
### \#docker
You need Docker on your local maschine. Docker must be installed and running.

Use this Link: <a name="https://www.docker.com/products/docker-desktop">https://www.docker.com/products/docker-desktop</a> 
to download Docker Desktop Community on your PC. Now you can install docker... its not magic.

### \#docker-compose
After you installed docker. Now you need docker-compose to deploy all services. You can go on this site: 
<a href="https://docs.docker.com/compose/install/">https://docs.docker.com/compose/install/</a> now follow the Instructions
Now you are done and you can start with the next step.

<a name="configure-your-local-pc">

## \#configure your local pc
Requirement for working instance on your local machine you finded here...

### \# change host file

You must modify your hostfile. You can find it on MacOS under `/etc/hosts`. Here you paste
this line.
```
127.0.0.1 vof.local
```
 
### \#create ssh key
First you must create your own ssh key, its realy easy!

```
Commandline for MacOS users

$> ssh-keygen -t rsa -b 4096 -C "marco.schauer@darkdevelopers.de"
```

* -t is the encryption type
* -b is the encryption strangth (requirement 4096)!
* -C is an command

![create-ssh-key](/images/install-project/create-ssh-key.png)

Now you can set the Path to save the key files. 
Enter the full path `/Users/mschauer/.ssh/dummy` to save your key file in the .ssh folder.

> {danger} Now enter a passphrase (Password) for your key file! 

You has success full created your key file. Now you must send `Marco Schauer (marco.schauer@darkdevelopers.de)` the content from your *.pub ssh file. 

```
Under MacOS you can use

$> cat ~/.ssh/bitbucket.org.pub | pbcopy
```

> {success} Congratulation you create successfully a ssh key and sended the content from the *.pub file to Marco. 

### \#create ssh config

We need to create a ssh config file, to link the ssh key to the right route.
Its super easy. Go to 
```
$> cd ~/.ssh
$> vim config
```


> {danger} Change this line IdentityFile ~/.ssh/[FILE FROM YOUR SSH FILE!!]

Paste following code in your terminal:

```
Host bitbucket.org-vof
  HostName bitbucket.org
  User git
  AddKeysToAgent yes
  IdentityFile ~/.ssh/[FILE FROM YOUR SSH FILE!!]
```

save the file and close it with `:wq`

>{success} Congratulation you are done with a another step!


<a name="install-git">

## \#install git & git-flow
Git is a version controll system.

### \#install git

To install git use this Documentation: <a href="https://gist.github.com/derhuerst/1b15ff4652a867391f03">https://gist.github.com/derhuerst/1b15ff4652a867391f03</a>

### \#install git-flow

To install git-flow use <a href="https://github.com/nvie/gitflow/wiki/Installation">https://github.com/nvie/gitflow/wiki/Installation</a> link.
>{info} https://danielkummer.github.io/git-flow-cheatsheet/

<a name="install-shop">

## \#install shop

Now comes the funny part install the shop. First step you go to http://bitbucket.org
Log into your Account and go to the repository ``shop.vof.laravel``

> {warning} https://bitbucket.org/vofvapeshop/shop.vof.laravel/src/master/ <= Repo Link

You must clone this repo to your local pc with this commend:
```
$> git clone git@bitbucket.org-vof:vofvapeshop/shop.vof.laravel.git
```

Go in the folde you are cloned and run this Command `bin\install`.
Now you can drink an Coffee and look the installation.

After installing done open your browser and call http://vof.local
