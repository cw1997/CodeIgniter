#!/usr/bin/env bash

# translator:昌维 <867597730@qq.com>
# repository:https://github.com/cw1997/CodeIgniter-Simplified-Chinese
# Translated at 2016-11-19 17:04:15

cd $(dirname $BASH_SOURCE)

if [ $# -eq 0 ]; then
	# echo 'Usage: '$BASH_SOURCE' <version_number>'
	echo '语法: '$BASH_SOURCE' <版本号>'
	exit 1
fi

version_number=$1

if [ ${#version_number} -lt 5 ]
then
	# echo "Provided version number is too short"
	echo "提供的版本号过短"
	exit 1
elif [ ${version_number: -4} == "-dev" ]
then
	# echo "'-dev' releases are not allowed"
	echo "'-dev' 版本不被允许"
	exit 1
fi

version_id=${version_number:0:5}
version_id=${version_id//./}
upgrade_rst='user_guide_src/source/installation/upgrade_'$version_id'.rst'

if [ ${#version_id} -ne 3 ]
then
	# echo "Invalid version number format"
	echo "版本号格式无效"
	exit 1
elif [ `grep -c -F --regexp="'$version_number'" system/core/CodeIgniter.php` -ne 1 ]
then
	# echo "Provided version number doesn't match in system/core/CodeIgniter.php"
	echo "提供版本号与 system/core/CodeIgniter.php 中的不匹配"
	exit 1
elif [ `grep -c -F --regexp="'$version_number'" user_guide_src/source/conf.py` -ne 2 ]
then
	# echo "Provided version number doesn't match in user_guide_src/source/conf.py"
	echo "提供版本号与 user_guide_src/source/conf.py 中的不匹配"
	exit 1
elif [ `grep -c -F --regexp="$version_number (Current version) <https://codeload.github.com/bcit-ci/CodeIgniter/zip/$version_number>" user_guide_src/source/installation/downloads.rst` -ne 1 ]
then
	# echo "user_guide_src/source/installation/downloads.rst doesn't appear to contain a link for this version"
	echo "user_guide_src/source/installation/downloads.rst 中没有包含这个版本的链接"
	exit 1
elif [ ! -f "$upgrade_rst" ]
then
	# echo "${upgrade_rst} doesn't exist"
	echo "${upgrade_rst} 不存在"
	exit 1
fi

# echo "Running tests ..."
echo "运行测试..."

cd tests/
phpunit

if [ $? -ne 0 ]
then
	# echo "Build FAILED!"
	echo "构建失败！"
	exit 1
fi

cd ..
cd user_guide_src/

echo ""
# echo "Building HTML docs; please check output for warnings ..."
echo "正在构建HTML文档,请检查输出警告..."
echo ""

make html

echo ""

if [ $? -ne 0 ]
then
	# echo "Build FAILED!"
	echo "构建失败！"
	exit 1
fi

# echo "Building EPUB docs; please check output for warnings ..."
echo "正在构建EPUB文档,请检查输出警告..."
echo ""

make epub

echo ""

if [ $? -ne 0 ]
then
	# echo "Build FAILED!"
	echo "构建失败！"
	exit 1
fi

cd ..

if [ -d user_guide/ ]
then
	rm -r user_guide/
fi

cp -r user_guide_src/build/html/ user_guide/
cp user_guide_src/build/epub/CodeIgniter.epub "CodeIgniter ${version_number}.epub"

# echo "Build complete."
echo "构建成功"
