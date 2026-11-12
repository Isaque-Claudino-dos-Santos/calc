# Calc

![Static Badge](https://img.shields.io/badge/PHP-8.4-blue)

## Commands

### Run with Makefile

```bash
    make
```

### Create system alias

Define calc root path
```bash 
    export CALC_PATH="$(pwd)/calc"
```

Define alias `calc` in system
```bash
    echo "alias calc='php ${HOME}${CALC_PATH}/index.php'" >> .bashrc && source .bashrc
```
