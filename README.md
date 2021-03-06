# weegotoschool

A map to dispaly mutliple routes to help people share cars to get kids at school

## Running ##

Weegotoschool can easily be run on OpenShift (the Open Source Platform as a Service (PaaS)) provided by Red Hat.

Start first with creating an account on OpenShift, it is free and require nothing less than a valid email address:
- [Create an OpenShift account by clicking me](https://www.openshift.com/app/account/new)

Once this step achieved, you can then just clic the following link:
- [Instantiate WeeGoToSchool Cartridge on OpenShift by clicking me](https://openshift.redhat.com/app/console/application_types/custom?name=weegotoschool&initial_git_url=https%3A%2F%2Fgithub.com/akram/weegotoschool.git&cartridges[]=php-5.4&cartridges[]=mongodb)

Which is also available by clicking the Red Ribbon from WeeGoToSchool GitHub Site 
- [Visit WeeGoToSchool GitHub Site](http://akram.github.io/weegotoschool/)

## Contributing ##
To contribute weegotoschool start by forking this repo and the submit Pull Requests to get your changes accepted.

Developing on OpenShift also creates an embedded git repository in OpenShift.
To simplyify developing, I hardly encourage you to enables dual push to simultaneously push all your commits on OpenShift and on your GitHub account.

To do this: Add a remote named "all" and add 2 push urls to it.
```
git remote add all ssh://23456781234567@yourapp-namespace.rhcloud.com/~/git/weegotoschool.git
git remote set-url origin --push --add ssh://23456781234567@weegotoschool-namespace.rhcloud.com/~/git/weegotoschool.git
git remote set-url origin --push --add git@github.com:youruser/weegotoschool.git
```

Then set the remote named 'all' as the default push remote:
```
git push -u all
```
To commit and push your code, proceed as usual: It will push on the 2 remotes and deploy on OpenShift

```
git add .
git commit -m "my commit"
git push
```
