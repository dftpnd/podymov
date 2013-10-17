<script type="text/javascript" src='http://www.scribd.com/javascripts/scribd_api.js'></script>

<div id='embedded_doc' >
<a href='http://www.scribd.com'>Scribd</a>
</div>

<script type="text/javascript">
  var url = 'http://lib.store.yahoo.net/lib/paulgraham/onlisp.ps';
  var pub_id = 'pub-22722262250074555563';
  var scribd_doc = scribd.Document.getDocFromUrl(url, pub_id);

  var onDocReady = function(e){
    scribd_doc.api.setPage(3);
  }

  scribd_doc.addEventListener('docReady', onDocReady);
  scribd_doc.addParam('jsapi_version', 2);
  scribd_doc.addParam('height', 600);
  scribd_doc.addParam('width', 800);
  scribd_doc.addParam('public', true);
  
  scribd_doc.write('embedded_doc');
</script>