  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      {{ config('jdev.version') }}
    </div>
    <!-- Default to the left -->
    <strong>
      {{ trans('general.copyright') }} &copy; <?php echo date('Y')?>
      <a href="#">{{config('jdev.name')}}</a>
    </strong>&nbsp;
    {{trans('general.rights_reserved')}}
  </footer>