#OrangeForm

You often have the problem (when organising little events) that you a simple 
web form with which you're able to create data sets from people and do immediately.
In my case the e-mail addresses and names of young student in an orientation period.

So here's my quick and dirty script, that can be configured via a simple config.yaml
file.

##config.yaml

```yaml
    ## Config file.
    ## TODO add more info
    ---
    header:
      title: Test
      description: descr...
      ##Select a theme, currently only bootstrap is supported
      theme: bootstrap
      ##Execute a command on the console. {{field_name}} is replaced with the field_name's field's actual value.
      exec:
      ##(Optional) Execute a query on a mysql database
      mysql_exec:
        server: 
        user:
        password:
        database:
        ##Executed query. {{field_name}} is replaced with the field_name's field's actual value.
        ##Important: The values aren't escaped. Use it with care.
        query:
      php_exec:
        echo "Some php code"
      ##Information that is displayed after submitting a data set
      info: |
            Some text. {{field_name}} is replaced with the field_name's field's actual value.
            {{exec_output}} is replaced with the output of the command execution via exec.
            {{exec_php_output}} is replaced with the output of the php code via php_exec.
      ##simple passwort to restrict the usage of this form
      password: test
  fields:
    [first_field_name]:
        title: first field
        [...]
    [...]
    [last_field_name]:
        [...]
```

###Fields
Different types of fields are supported. Each field has title option which sets
the label title, an optional value option which sets the default value and a type option
(if no type is given, inputfield is used). 

Supported types are:
- textarea
- number
- inputfield
- password
- checkbox
- color
- email

##Licence
GNU GPL v3 (of course)