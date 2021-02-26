# See here for image contents: https://github.com/microsoft/vscode-dev-containers/tree/v0.158.0/containers/php/.devcontainer/base.Dockerfile

# [Choice] PHP version: 8, 8.0, 7, 7.4, 7.3
ARG VARIANT="8"
FROM mcr.microsoft.com/vscode/devcontainers/php:0-${VARIANT}

# [Option] Install Node.js
ARG INSTALL_NODE="true"
ARG NODE_VERSION="lts/*"
RUN if [ "${INSTALL_NODE}" = "true" ]; then su vscode -c "umask 0002 && . /usr/local/share/nvm/nvm.sh && nvm install ${NODE_VERSION} 2>&1"; fi

RUN apt update \
  && apt -y upgrade \
  && apt install -y zlib1g-dev libpng-dev libfreetype6-dev libjpeg62-turbo-dev

USER vscode

RUN sudo docker-php-ext-configure gd --with-freetype --with-jpeg \
  && sudo -E docker-php-ext-install -j$(nproc) gd \
  && composer global require laravel/installer

ENV PATH $PATH:~/.composer/vendor/bin

# [Optional] Uncomment this section to install additional OS packages.
# RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
#     && apt-get -y install --no-install-recommends <your-package-list-here>

# [Optional] Uncomment this line to install global node packages.
# RUN su vscode -c "source /usr/local/share/nvm/nvm.sh && npm install -g <your-package-here>" 2>&1