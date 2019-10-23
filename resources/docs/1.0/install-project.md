# Install Project

Install the Developer Instance from this VOF Shop.

---

- [Install Docker](/{{route}}/{{version}}/install-project#install-docker)
- [Configure your local PC](/{{route}}/{{version}}/install-project#configure-your-local-pc)

<a name="install-docker">

## \#Install Docker
Docker is an container service, to make visual containers. Its shortly sayed an VM Software but nicer...
### \#Docker
You need Docker on your local maschine. Docker must be installed and running.

Use this Link: <a name="https://www.docker.com/products/docker-desktop">https://www.docker.com/products/docker-desktop</a> 
to download Docker Desktop Community on your PC. Now you can install docker... its not magic.

### \#docker-compose
After you installed docker. Now you need docker-compose to deploy all services. You can go on this site: 
<a href="https://docs.docker.com/compose/install/">https://docs.docker.com/compose/install/</a> now follow the Instructions
Now you are done and you can start with the next step.

<a name="configure-your-local-pc">

## \#Configure your local PC
Requirement for working instance on your local machine you finded here...
 
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
