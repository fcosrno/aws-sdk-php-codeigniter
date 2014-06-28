# AWS Library for Codeigniter 2

A simple Codeigniter 2.x.x library for including the latest AWS SDK for PHP (currently 2.x.x). Plus, a few helper functions.

## Wait, why use a CodeIgniter library?

The current version of the AWS SDK uses namespaces, which we cannot use in Codeigniter 2. By wrapping the SDK in this library we can hook into it from CodeIgniter without the need of namespaces within the framework.

## Installation

Install AWS SDK via Composer...

```php
{
    "require": {
        "aws/aws-sdk-php": "2.*"
    }
}
```

Remember to include Composer's autoload file in index.php:

```php
require_once './vendor/autoload.php';
```

Then copy `application/config/aws_sdk.php` and `application/libraries/Aws_sdk.php` into your project.

## Configuration

Edit the AWS credentials in `application/config/aws_sdk.php`.

```php
$config['aws_access_key']="Your-access-key";
$config['aws_secret_key']="Your-secret-key";
```
 

## Usage

Load the library like any other...
```php
$this->load->library('aws_sdk');
```

Then call methods as documented in the [AWS SDK for PHP guide](http://docs.aws.amazon.com/aws-sdk-php/guide/latest/), prepending `$this->aws_sdk` before the method name.
```php
$this->aws_sdk->listBuckets(); 
```

For example, if you want to create a bucket, the AWS SDK for PHP guide recommends you use the following...
```php
$client->createBucket(array('Bucket' => 'mybucket'));
```

The equivalent of that would be...
```php
$this->load->library('aws_sdk');
$this->aws_sdk->createBucket(array('Bucket' => 'mybucket'));
```



## Helper functions

### saveObject()

This is an extension of putObject. It works the same way except that it checks for duplicate keys (file names). If an object with the same key exists, it appends a unix timestamp to the filename.

Example:
```php
try{
	$aws_object=$this->aws_sdk->saveObject(array(
	    'Bucket'      => 'mybucket',
	    'Key'         => 'key',
	    'ACL'		  => 'public-read',
	    'SourceFile'  => 'source',
	    'ContentType' => 'image/jpeg'
	))->toArray();
}catch (Exception $e){
	$error = "Something went wrong saving your file.\n".$e;
}
```

### saveObjectInBucket()
A function that wraps all the useful steps in creating a new object within a (potentially) new bucket. It runs the following:

1. Creates the bucket if it doesn't exist.
2. Polls the bucket until it is accesible. This prevents moving on to the next step without an existing bucket.
3. Puts the object using saveObject().
4. Polls the object to make sure it was created.

Example:
```php
try{
	$aws_object=$this->aws_sdk->saveObjectInBucket(array(
	    'Bucket'      => 'mybucket',
	    'Prefix'	  => 'prefix',
	    'Key'         => 'key',
	    'SourceFile'  => 'source',
	))->toArray();
}catch (Exception $e){
	$error = "Something went wrong saving your file.\n".$e;
}
```

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Added some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request


## Links

* [AWS SDK latest documentation](http://docs.aws.amazon.com/aws-sdk-php/guide/latest/)
* [AWS SDK for PHP on Github](http://github.com/aws/aws-sdk-php)
