<script>
    function addValue(element, value)
    {
        var values = element.value.split("|");
        for(var i = 0; i < values.length; i++)
        {
            if(values[i] === value)
            {
                return;
            }
        }
        values.push(value);
        element.value = values.join("|");
        element.closest('form').submit();
    }
    function removeValue(element, value)
    {
        var values = element.value.split("|");
        for(var i = 0; i < values.length; i++)
        {
            if(values[i] === value)
            {
                values.splice(i, 1);
            }
        }
        element.value = values.join("|");
        element.closest('form').submit();
    }
</script>