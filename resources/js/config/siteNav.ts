import type { TranslationKey } from '@/types/translations';

export type SiteNavItem = {
    labelKey: TranslationKey;
    href: string;
};

export const siteNavItems: SiteNavItem[] = [
    { labelKey: 'site.nav.about', href: '/about' },
    { labelKey: 'site.nav.documents', href: '/documents' },
    { labelKey: 'site.nav.groups', href: '/groups' },
    { labelKey: 'site.nav.team', href: '/team' },
    { labelKey: 'site.nav.gallery', href: '/gallery' },
    { labelKey: 'site.nav.contacts', href: '/contacts' },
];
