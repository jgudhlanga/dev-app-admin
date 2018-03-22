  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      {{ config('system.version') }}
    </div>
    <!-- Default to the left -->
    <strong>
      {{ trans('general.copyright') }} &copy; <?php echo date('Y')?>
      <a href="#">{{config('system.name')}}</a>
    </strong>&nbsp;
    {{trans('general.rights_reserved')}}
  </footer>