
## dev-config

### Installation

`composer require phlpdtrt/dev-config`


### Configuration

there is nothing to configure

### Usage

simply call the console command *phlpdtrt:dev-config:set* followed by the config path and the new value. You can set any value for any config path as long the path starts with "dev".

`bin/magento phlpdtrt:dev-config:set dev/static/sign 1`

this command for instance activates the "sign static files" feature.