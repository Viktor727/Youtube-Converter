"# Youtube-Converter" 

- Youtube Converter Uses ffmpeg to convert mp4 to mp3. Please, install ffmpeg before deploy.
you can use static builds of ffmpeg. Please check conf.php file to set up Path to the ffmpeg executable file
- Youtube Converter Uses youtube-dl to download video and captions from youtube, please install it.
- Youtube Converter Uses zip to zip captions after they are downloaded from youtube.

- Added Cron To Remove Files every 2 hours
sudo crontab -e

-- need to add permission for videos folder. FFMPEG could crash without it
sudo chown -Rf apache:apache /var/www/html/videos
sudo chmod 0777 /var/www/html/videos

-- For Now you can download only 1024 GB and less
you can change These options in /etc/php.ini
max_execution_time and memory_limit
