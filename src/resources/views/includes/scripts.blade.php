<?php
?>
<script>
// Feature flags: _FF.is('fu')
function _FF() {
    if (!_FF._v) {
        _FF._v = JSON.parse('{!! json_encode(ff_all(1)) !!}');
        if (typeof _FF._v === 'object' && _FF._v !== null) {
            for (var i in _FF._v) {
                if (!_FF._v.hasOwnProperty(i)) continue;
                _FF[i] = _FF._v[i];
            }
        } else {
            _FF._v = {}
        }
    }
    return _FF._v;
}
_FF.is = function(k) { _FF(); return (typeof _FF._v[k] !== 'undefined') ? !!_FF._v[k] : false }
_FF.dump = function() { _FF(); console.log(JSON.stringify(_FF._v,null,2)) }
_FF();
</script>
