# Mosaiqo Optimus Prime

Is a simple package to transform collection and entities TO a JSON - API before the response is returned to the requester.
Think of it like the view presenter so you can adjust your output before, and maintain a clean API even if you change the DDBB structure.

![Optimus Prime](http://3.bp.blogspot.com/-sIWGv6LZHhw/Tg9E9cF8E7I/AAAAAAAADdQ/cLXAIAUcVRU/s320/g1+optimus+prime+face_9920002211-03.jpg)


## Instalation
------------------------------------------------

To install Mosaiqo Optimus Prime is really simple just install it with composer:

```
	composer require mosaiqo/optimus-prime "dev-master"
```

after it just put this line in your laravel app/config.php file :

```
	'Mosaiqo\OptimusPrime\TransformerServiceProvider',
```


now you can begin to play with your transformers.

   
    

    
## How to transform your API
------------------------------------------------

It's really easy to use Optimus Prime transformer.    
In the model you want to use a transformer just have to implement the `Mosaiqo\OptimusPrime\Decepticons`interface.
this interface forces you to use some methods to determine the transformer class.   
But we have made it easy for you just pull in the `Mosaiqo\OptimusPrime\Transformable` trait we have created.



```

<?php namespace Foo\Bar;

use Illuminate\Database\Eloquent\Model;

use Mosaiqo\OptimusPrime\Contracts\Decepticons;
use Mosaiqo\OptimusPrime\Transformable;

class Foo extends Model implements Decepticons
{
	use Transformable;
	

}

```