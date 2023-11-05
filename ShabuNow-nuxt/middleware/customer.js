export default defineNuxtRouteMiddleware((to, from) => {
  const tokenStore = useTokenStore();
  const auth = useAuthStore();
  const route = useRoute();
  if (!tokenStore.getStatus) {
    return navigateTo("/login");
  }
  if (auth.getUser.role === "customer") {
    return navigateTo("/");
  } else if (auth.getUser.role === "staff") {
    return navigateTo("/")
  }
});
