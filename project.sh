#!/bin/bash
MAIN=docker-compose.yml
CONFIG=build/project-config.yml
CONNECT="-f $MAIN -f $CONFIG"

ROOT=$(pwd)
CONF_DIR=$ROOT/build
RUN=$ROOT/run


_projectctl() {
    _script_commands=$(run list)
    local cur
    COMPREPLY=()
    cur="${COMP_WORDS[COMP_CWORD]}"
    prev="${COMP_WORDS[COMP_CWORD-1]}"
    if [[ $_script_commands = *"$prev"* ]]; then
        return 0
    fi
    COMPREPLY=( $(compgen -W "${_script_commands}" -- ${cur}) )

    return 0
}

function ComposeCommand {
    docker-compose $CONNECT $@
}

function ComposeCommandExec {
    ComposeCommand exec -T --user $(id -u):$(id -g) $@
}

function CopyFileProjectConfig {
    cp build/$@/project-config.yml build/
}

function run() {
    COMMAND=$1
    case "$COMMAND" in
        install|update)
            echo "$COMMAND  Project"
            Dependencies $@
        ;;
        quick_start)
            echo "Quick Start Project"
            echo "Envelopment: $2"
            CopyFileProjectConfig $2
        ;;
        remove)
            echo 'Remove Project'
            ComposeCommand down -v --rmi local
        ;;
        down|up|stop|restart|build|pull|logs|rm|run)
            ComposeCommand $@
        ;;
        exec)
            shift
            ComposeCommandExec $@
        ;;
        list)
            echo rm run install remove down up stop restart build pull exec \
            web analyze_diff analyze_phpstan analyze_phpmd ssl-init ssl-renew \
            quick_start \
             help
        ;;
        help)
            ShowHelp
        ;;
        *)
            complete -o default -o nospace -F _projectctl ./project.sh
        ;;
    esac
}

run $@
