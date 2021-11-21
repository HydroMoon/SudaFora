<template>
    <PerfrectScrollbar
        tagname="nav"
        aria-label="main"
        class="relative flex flex-col flex-1 max-h-full gap-4 px-3"
    >
        <!-- Provider Sidebar -->
        <SidebarLink
            v-show="$page.props.auth.user.user_type === 1"
            title="Dashboard"
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            <template #icon>
                <DashboardIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            v-show="$page.props.auth.user.user_type === 1"
            title="Profile"
            :href="route('profile')"
            :active="route().current('profile')"
        >
            <template #icon>
                <UserIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            v-show="$page.props.auth.user.user_type === 1"
            title="Requests"
            :href="route('requests')"
            :active="route().current('requests')"
        >
            <template #icon>
                <CollectionIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            v-show="$page.props.auth.user.user_type === 1"
            title="Reports"
            :href="route('archive')"
            :active="route().current('archive')"
        >
            <template #icon>
                <ArchiveIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <!-- User Sidebar -->
        <SidebarLink
            v-show="$page.props.auth.user.user_type === 0"
            title="Dashboard"
            :href="route('user.dashboard')"
            :active="route().current('user.dashboard')"
        >
            <template #icon>
                <DashboardIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            v-show="$page.props.auth.user.user_type === 0"
            title="User Profile"
            :href="route('user.profile')"
            :active="route().current('user.profile')"
        >
            <template #icon>
                <UserIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            v-show="$page.props.auth.user.user_type === 0"
            title="User Requests"
            :href="route('user.request')"
            :active="route().current('user.request')"
        >
            <template #icon>
                <CollectionIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <!-- <SidebarCollapsible title="Dropdown">
            <SidebarCollapsibleItem href="#" title="Link 1" :active="false" />
            <SidebarCollapsibleItem href="#" title="Link 2" :active="true" />
            <SidebarCollapsibleItem href="#" title="Link 3" :active="false" />
        </SidebarCollapsible> -->



        <!-- Examples -->
        <!-- 
        External link example
        <SidebarLink
            title="Github"
            href="https://github.com/kamona-wd/kui-laravel-breeze"
            external
            target="_blank"
        >
        </SidebarLink>

        Collapsible examples
        <SidebarCollapsible title="Users" :active="$page.url.startsWith('/users')">
            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="$page.url === '/users/index'" />
            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="$page.url === '/users/create'" />
        </SidebarCollapsible>

        <SidebarCollapsible title="Users" :active="usePage().url.value.startsWith('/users')">
            <template #icon>
                <UserIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="route().current('users.index')" />
            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="route().current('users.create')" />
        </SidebarCollapsible> -->
    </PerfrectScrollbar>
</template>

<script>
import PerfrectScrollbar from '@/Components/PerfectScrollbar'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
import { DashboardIcon } from '@/Components/Icons/outline.jsx'
import SidebarCollapsible from '@/Components/Sidebar/SidebarCollapsible.vue'
import SidebarCollapsibleItem from '@/Components/Sidebar/SidebarCollapsibleItem.vue'
import { UserIcon, CollectionIcon, ArchiveIcon } from '@heroicons/vue/outline'

export default {
    components: {
        PerfrectScrollbar,
        SidebarLink,
        UserIcon,
        DashboardIcon,
        CollectionIcon,
        ArchiveIcon,
        SidebarCollapsible,
        SidebarCollapsibleItem,
    },
}
</script>
