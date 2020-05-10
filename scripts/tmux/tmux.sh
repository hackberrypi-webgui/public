#!/bin/bash

sessionList=$(tmux ls)

if [[ $sessionList == *"kali-session"* ]]; then
  tmux attach-session -t kali-session
else
  tmux new-session -s kali-session 'bash --init-file /root/scripts/tmux/load.sh'
fi
