<script setup>
import { ref } from 'vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {
  Dialog,
  DialogPanel,
  Menu,
  MenuButton,
  MenuItems,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue';
import {
  Bars3Icon,
  BellIcon,
  CalendarIcon,
  HomeIcon,
  UsersIcon,
  XMarkIcon,
} from '@heroicons/vue/24/outline';
import { ChevronDownIcon, MagnifyingGlassIcon } from '@heroicons/vue/20/solid';

const sidebarOpen = ref(false);
</script>
<template>
  <div>
    <TransitionRoot as="template" :show="sidebarOpen">
      <Dialog
        as="div"
        class="relative z-50 lg:hidden"
        @close="sidebarOpen = false"
      >
        <TransitionChild
          as="template"
          enter="transition-opacity ease-linear duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="transition-opacity ease-linear duration-300"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-gray-900/80" />
        </TransitionChild>

        <div class="fixed inset-0 flex">
          <TransitionChild
            as="template"
            enter="transition ease-in-out duration-300 transform"
            enter-from="-translate-x-full"
            enter-to="translate-x-0"
            leave="transition ease-in-out duration-300 transform"
            leave-from="translate-x-0"
            leave-to="-translate-x-full"
          >
            <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
              <TransitionChild
                as="template"
                enter="ease-in-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in-out duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0"
              >
                <div
                  class="absolute left-full top-0 flex w-16 justify-center pt-5"
                >
                  <button
                    type="button"
                    class="-m-2.5 p-2.5"
                    @click="sidebarOpen = false"
                  >
                    <span class="sr-only">Close sidebar</span>
                    <XMarkIcon class="h-5 w-5 text-white" aria-hidden="true" />
                  </button>
                </div>
              </TransitionChild>
              <!-- Sidebar component, swap this element with another sidebar if you like -->
              <div
                class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4"
              >
                <div class="flex h-16 shrink-0 items-center">
                  <img
                    class="h-8 w-auto"
                    src="https://cdn.thebrag.com/tbm/The-Brag-Media.svg"
                    alt="Your Company"
                  />
                </div>
                <nav class="flex flex-1 flex-col">
                  <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                      <ul role="list" class="-mx-2 space-y-1">
                        <li>
                          <NavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                            class="group flex gap-x-3 px-3 py-3 text-base leading-6 font-semibold text-gray-400 hover:text-gray-700 hover:bg-gray-50 w-full"
                          >
                            <HomeIcon
                              class="text-gray-400 group-hover:text-gray-600 h-5 w-5 shrink-0"
                              aria-hidden="true"
                            />
                            Dashboard
                          </NavLink>
                        </li>
                        <li v-if="$page.props.auth.user.role === 'Manager'">
                          <NavLink
                            :href="route('staff')"
                            :active="route().current('staff')"
                            class="group flex gap-x-3 px-3 py-3 text-base leading-6 font-semibold text-gray-400 hover:text-gray-700 hover:bg-gray-50 w-full"
                          >
                            <UsersIcon
                              class="text-gray-400 group-hover:text-gray-600 h-5 w-5 shrink-0"
                              aria-hidden="true"
                            />
                            Staff
                          </NavLink>
                        </li>
                        <li>
                          <NavLink
                            :href="route('venue')"
                            :active="route().current('venue')"
                            class="group flex gap-x-3 px-3 py-3 text-base leading-6 font-semibold text-gray-400 hover:text-gray-700 hover:bg-gray-50 w-full"
                          >
                            <CalendarIcon
                              class="text-gray-400 group-hover:text-gray-600 h-5 w-5 shrink-0"
                              aria-hidden="true"
                            />
                            Venues
                          </NavLink>
                        </li>
                        <li>
                          <NavLink
                            :href="route('logs')"
                            :active="route().current('logs')"
                            class="group flex gap-x-3 px-3 py-3 text-base leading-6 font-semibold text-gray-400 hover:text-gray-700 hover:bg-gray-50 w-full"
                          >
                            <CalendarIcon
                              class="text-gray-400 group-hover:text-gray-600 h-5 w-5 shrink-0"
                              aria-hidden="true"
                            />
                            Logs
                          </NavLink>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div
      class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col"
    >
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div
        class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4"
      >
        <div class="flex h-16 shrink-0 items-center">
          <img
            class="h-8 w-auto"
            src="https://cdn.thebrag.com/tbm/The-Brag-Media.svg"
            alt="Your Company"
          />
        </div>
        <nav class="flex flex-1 flex-col">
          <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
              <ul role="list" class="-mx-2 space-y-1">
                <li>
                  <NavLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                    class="group flex gap-x-3 px-3 py-3 text-base leading-6 font-semibold text-gray-400 hover:text-gray-700 hover:bg-gray-50 w-full"
                  >
                    <HomeIcon
                      class="text-gray-400 group-hover:text-gray-600 h-5 w-5 shrink-0"
                      aria-hidden="true"
                    />
                    Dashboard
                  </NavLink>
                </li>
                <li v-if="$page.props.auth.user.role === 'Manager'">
                  <NavLink
                    :href="route('staff')"
                    :active="route().current('staff')"
                    class="group flex gap-x-3 px-3 py-3 text-base leading-6 font-semibold text-gray-400 hover:text-gray-700 hover:bg-gray-50 w-full"
                  >
                    <UsersIcon
                      class="text-gray-400 group-hover:text-gray-600 h-5 w-5 shrink-0"
                      aria-hidden="true"
                    />
                    Staff
                  </NavLink>
                </li>
                <li>
                  <NavLink
                    :href="route('venue')"
                    :active="route().current('venue')"
                    class="group flex gap-x-3 px-3 py-3 text-base leading-6 font-semibold text-gray-400 hover:text-gray-700 hover:bg-gray-50 w-full"
                  >
                    <CalendarIcon
                      class="text-gray-400 group-hover:text-gray-600 h-5 w-5 shrink-0"
                      aria-hidden="true"
                    />
                    Venues
                  </NavLink>
                </li>
                <li>
                  <NavLink
                    :href="route('logs')"
                    :active="route().current('logs')"
                    class="group flex gap-x-3 px-3 py-3 text-base leading-6 font-semibold text-gray-400 hover:text-gray-700 hover:bg-gray-50 w-full"
                  >
                    <CalendarIcon
                      class="text-gray-400 group-hover:text-gray-600 h-5 w-5 shrink-0"
                      aria-hidden="true"
                    />
                    Logs
                  </NavLink>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>

    <div class="lg:pl-72">
      <div class="sticky top-0 z-40 lg:mx-auto lg:px-8">
        <div
          class="flex h-16 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-0 lg:shadow-none"
        >
          <button
            type="button"
            class="-m-2.5 p-2.5 text-gray-700 lg:hidden"
            @click="sidebarOpen = true"
          >
            <span class="sr-only">Open sidebar</span>
            <Bars3Icon class="h-5 w-5" aria-hidden="true" />
          </button>

          <!-- Separator -->
          <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true" />

          <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
            <div class="flex justify-end w-full items-center ml:auto">
              <!-- Profile dropdown -->
              <Menu as="div" class="relative">
                <MenuButton class="-m-1.5 flex items-center p-1.5">
                  <span
                    class="mlx-3 py-3 text-base font-semibold leading-6 text-gray-900"
                    aria-hidden="true"
                    >{{ $page.props.auth.user.name }}</span
                  >
                  <ChevronDownIcon
                    class="ml-2 h-5 w-5 text-gray-400"
                    aria-hidden="true"
                  />
                </MenuButton>
                <transition
                  enter-active-class="transition ease-out duration-100"
                  enter-from-class="transform opacity-0 scale-95"
                  enter-to-class="transform opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75"
                  leave-from-class="transform opacity-100 scale-100"
                  leave-to-class="transform opacity-0 scale-95"
                >
                  <MenuItems
                    class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                  >
                    <ResponsiveNavLink
                      :class="[
                        active ? 'bg-gray-50' : '',
                        'block px-3 pyx-3 py-3 text-base leading-6 text-gray-900',
                      ]"
                      :href="route('profile.edit')"
                    >
                      Profile
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                      :href="route('logout')"
                      :class="[
                        active ? 'bg-gray-50' : '',
                        'block px-3 pyx-3 py-3 text-base leading-6 text-gray-900',
                      ]"
                      method="post"
                      as="button"
                    >
                      Log Out
                    </ResponsiveNavLink>
                  </MenuItems>
                </transition>
              </Menu>
            </div>
          </div>
        </div>
      </div>

      <main class="py-10">
        <div class="mx-auto w-full px-4 sm:px-6 lg:px-8">
          <slot />
        </div>
      </main>
    </div>
  </div>
</template>
