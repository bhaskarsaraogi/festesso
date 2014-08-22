</article>
</div>
<footer class="row" role="footer">
  <div class="span12">
    <p><?php echo anchor('main/changelog', 'Changelog'); ?></p>
    <?php if ($this->session->userdata('admin_controls')) { ?>
    <p><span class="label label-important">Danger</span> Please leave this page if you are not an administrator.</p>
    <?php } ?>
  </div>
</footer>
</div>
</body>

</html>