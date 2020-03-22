"# Youtube-Converter" 

Please do the following steps, to set up auto delete videos with date > 2 days
1. Install cron. Run following command:
apt-get install -y cron

2. Add the folowing line to your crontab /etc/cron.d/yourcrontab
* 23 * * * find path_to_your_site/videos/* -mtime +1 -type f -delete

3. Give execution rights on the cron job, Run the following command:
hmod 0644 /etc/cron.d/yourcrontab

4. Apply your cron job. Run:
crontab /etc/cron.d/hello-cron
