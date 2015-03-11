#!/bin/bash

declare -A git_projects

# set const
APP_ROOT_DIR=/app
GIT_ROOT_DIR=/app/gitroot
WEB_ROOT_DIR=/app/website

# set git projects
git_projects=(["jx"]="$WEB_ROOT_DIR/jx" ["test"]="$WEB_ROOT_DIR/test")

# make dir
mkdir -p $GIT_ROOT_DIR $WEB_ROOT_DIR
ln -s $GIT_ROOT_DIR /gitroot

# install normal tools
apt-get update && apt-get -y upgrade || exit
SOFT_INSTALL="apt-get install -y tmux git git-core vim"
echo $SOFT_INSTALL
$SOFT_INSTALL || exit

# set tmux config
conf=$(cat <<EOF
set -g prefix C-l\nunbind C-b
EOF
)
echo -e $conf > ~/.tmux.conf

# init git pools
for k in "${!git_projects[@]}"
do
  CMD="git init $GIT_ROOT_DIR/$k --bare"
  echo $CMD
  $CMD
  post_receive=$(cat <<EOF
#!/bin/sh\ncd ${git_projects[${k}]} || exit\nunset GIT_DIR\ngit pull origin master\nexec git update-server-info
EOF
)
  post_receive_file=$GIT_ROOT_DIR/$k/hooks/post-receive
  echo -e $post_receive > $post_receive_file
  chmod +x $post_receive_file
done

