#!/bin/bash
echo 开始反编译$@
fullPath=$@
filePath=${fullPath%'.apk'}
outPath=out.${filePath}
#echo 开始提取资源文件...
#apktool d $@
#echo 开始创建文件夹
#mkdir ${fullPath}
echo 开始解压classes.dex...
unzip -od "${outPath}" $@ classes.dex
echo 开始反编译classes.dex为classes_dex2jar.jar...
d2j-dex2jar "${outPath}/classes.dex" -f -o "${outPath}/classes.jar"
echo 恭喜，反编译完成，请到${outPath}目录下查看

open -a /opt/homebrew-cask/Caskroom/jd-gui/0.3.5/JD-GUI.app "${outPath}/classes.jar"
