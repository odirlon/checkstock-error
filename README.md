<p>
Guys, I created a page to punitor the products that have this problem.
</p><p>
What's the downside: A public page will be created with all the products of your ecommerce, I recommend creating a very complex link and disable the indexing of thefts.
</p><p>
<b>Let's take the steps:</b>
</p><p>
01- Create a page-checkstock.php with the following code: https://github.com/odirlon/checkstock-error
</p><p>
02- Change the line 84 to receive the notifications.
</p><p>
03- Create a page with a complicated slug like this: "check-stock-2452233213321653441" and use the template created in the previous step.
</p><p>
04- Create a cron to check the page from time to time on the site: https://www.easycron.com/user
</p><p>
05- Ready, now whenever a stock bugar you will receive an email notifying you, or if you want to see if the site has an error simply access the page you created.
</p><p>
Remember to remove the cache from this page.
</p>
