#!/bin/bash
echo 开始反编译$@
fullPath=$@
filePath=${fullPath%'.apk'}
#echo 开始提取资源文件...
#apktool d $@
#echo 开始创建文件夹
#mkdir ${fullPath}
echo 开始解压classes.dex...
unzip -od "${filePath}" $@ classes.dex
echo 开始反编译classes.dex为classes_dex2jar.jar...
d2j-dex2jar "${filePath}/classes.dex" -f -o "${filePath}/classes.jar"
echo 恭喜，反编译完成，请到${filePath}目录下查看

open -a /opt/homebrew-cask/Caskroom/jd-gui/0.3.5/JD-GUI.app "${filePath}/classes.jar"
