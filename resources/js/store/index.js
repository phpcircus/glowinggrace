import { config } from 'Config';

export default {
    meta: {
        admin: {
            name: config.admin.name,
            email: config.admin.email,
            sites: {
                github: {
                    profile: config.admin.sites.github.profile,
                    url: config.admin.sites.github.url,
                },
                twitter: {
                    profile: config.admin.sites.twitter.profile,
                    url: config.admin.sites.twitter.url,
                },
            },
        },
        links: {
            template: {
                name: config.links.template.name,
                url: config.links.template.url,
            },
        },
    },
}
