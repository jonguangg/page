git init将当前文件夹设置为仓库

cd /d/AppServ/www/page每次都要先进这个目录

git add tianHua_heNan添加至本地库，只需执行一次
git add geHua_shanXi

git commit -m "这里写修改说明"//把文件提交到仓库，每次都要执行

git push -u origin master推送至远程库，每次都要执行







git config --global user.email "you@example.com"
git config --global user.name "Your Name"

★git remote add origin git@github.com:jonguangg/page.git
//添加远程库，只需执行一次,密码为tengsidi8
git remote rm origin删除远程库
jonguangg@163.com/secret
git clone git@github.com:jonguangg/page.git下载远程代码

★删除raindow文件夹及其下所有的文件
git rm raindow -r -f
同步删除操作到远程分支
git commit -m "delete raindow"
提交分支
git push origin master

★★★★★★★★★★★★★★★★★★★★★★★★★★★
git status//仓库状态
git diff readme.txt//查看readme.txt文件修改处
